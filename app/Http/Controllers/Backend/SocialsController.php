<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class SocialsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('facebook.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }

        $socials = Social::all(); // Fetch data from the 'socials' table using the Social model

        return view('backend.pages.social.index', compact('socials'));
    }
    
    public function login(Request $request)
    {
        $accountId = $request->input('account_id');

        // Assuming you have a model named 'UserAccount'
        $userAccount = UserAccount::find($accountId);

        if (!$userAccount) {
            return response()->json(['error' => 'Account not found.'], 404);
        }

        // Perform the login action here
        $loginUrl = ''; // Set the URL for login page (e.g., Facebook or Instagram)
        $response = Http::post($loginUrl, [
            'email' => $userAccount->email,
            'password' => $userAccount->password,
        ]);

        if ($response->ok()) {
            // If login successful, open a new tab with the logged-in account page
            return response()->json(['message' => 'Login successful.'], 200);
        } else {
            return response()->json(['error' => 'Login failed.'], 500);
        }
    }
    
    public function automateFacebookLogin(Request $request, $accountId)
    {
        // Get the account details from the database
        $account = Social::findOrFail($accountId);

        try {
            $process = new Process(['node', base_path('puppeteer_scripts/facebook-login.js'), $account->email, $account->password]);
            $process->mustRun();

            // Process output (logged URL after login)
            Log::info($process->getOutput());

            return response()->json(['success' => true]);
        } catch (ProcessFailedException $exception) {
            Log::error('Facebook login failed: ' . $exception->getMessage());
            return response()->json(['success' => false]);
        }
    }

}
