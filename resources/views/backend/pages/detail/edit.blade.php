
@extends('backend.layouts.master')

@section('title')
Role Edit - Admin Panel
@endsection

@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">details Edit - {{ $details->name }}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.detail.index') }}">All details</a></li>
                    <li><span>Edit details</span></li>
                </ul>
            </div>
        </div>
       
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit details</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.detail.update', $details->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Your Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $details->name }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" value="{{ $details->department }}">
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Admin Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $details->email }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="username">Admin Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required value="{{ $details->username }}">
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Data</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection


@section('scripts')
     {{-- @include('backend.pages.roles.partials.scripts') --}}
@endsection