<?php

namespace App\Http\Controllers\Backend;

use App\Models\Detail;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DetailsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('detail.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
    
       // Get the logged-in admin's user ID
    $userId = Auth::guard('admin')->user()->id;

    // Fetch details based on the user ID
    $details = Detail::where('user_id', $userId)->get();

    return view('backend.pages.detail.index', compact('details'));
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('detail.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $details  = Detail::all();
        // $roles  = Role::all();
        return view('backend.pages.detail.create', compact('details'));
    }
   /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

 public function store(Request $request)
 {
     // Validate the incoming request data
     $request->validate([
         'name' => 'required|max:255',
         'email' => 'required|email|unique:detail,email',
         'username' => 'required',
         'department' => 'required',
         'password' => 'required|min:6|confirmed',
         'roles' => 'array',
     ]);
 
     // Create a new Detail model instance with the validated data
     $details = new Detail([
         'name' => $request->name,
         'email' => $request->email,
         'username' => $request->username,
         'department' => $request->department,
         'password' => $request->password,
         'user_id' => Auth::guard('admin')->user()->id,
     ]);
 
     // Set the user_id to the current authenticated user's ID
     $details->user_id = Auth::id();
 
     // Save the detail to the database
     $details->save();
 
     // Redirect to a page (you can change this to the appropriate page)
     return redirect()->route('admin.detail.index')->with('success', 'Detail Added Successfully.');
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $details = Detail::find($id);
        return view('backend.pages.detail.edit', compact('details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Create New User
        $details = Detail::find($id);

        // Validation Data
        $request->validate([
            
        'name' => 'required|max:255',
        'email' => 'required|email',
        'username' => 'required',
        'department' => 'required',
        'password' => 'required|min:6|confirmed',
        ]);


        $details->name = $request->name;
        $details->email = $request->email;
        $details->username = $request->username;
        $details->department = $request->department;
        $details->password = $request->password;

        $details->save();

        

        session()->flash('success', 'User has been updated !!');
        return redirect()->route('admin.detail.index')->with('success', 'Detail Added Successfully.');

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the Detail model by the provided ID
        $detail = Detail::find($id);

        // If the Detail model exists, delete it
        if (!is_null($detail)) {
            $detail->delete();
            return redirect()->back()->with('success', 'Admin has been deleted successfully.');
        }

        // If the Detail model is not found, show an error message
        return redirect()->back()->with('error', 'Admin not found.');
    }
}