
@extends('backend.layouts.master')

@section('title')
Accessess - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Accessess Detail</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Accessess Detail</span></li>
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
                    <h4 class="header-title float-left">Accessess List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('detail.create'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.detail.create') }}">Add New Access</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="10%">Name</th>
                                    <th width="20%">Email</th>
                                    <th width="20%">Password</th>
                                    <th width="10%">Department</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($details as $detail)
                               <tr>
                                    <td>{{  $detail->id }}</td>

                                    <td>{{ $detail->name }}</td>
                                    <td>{{ $detail->email }}</td>
                                    <td>
                                        <span
                                            id="password_{{ $detail->id }}"
                                            data-password="{{ $detail->password }}"
                                            data-masked="********"
                                        >********</span>
                                        <input type="checkbox" class="showPasswordCheckbox" data-target="password_{{ $detail->id }}">
                                    </td>
                                   
                                    
                                    <td>{{ $detail->department }}</td>
                                   
                                    
                                    <td>
                                      

                                        <form action="{{ route('admin.detail.destroy', $detail->id) }}" method="POST">
    @csrf  @if (Auth::guard('admin')->user()->can('detail.edit'))
    <a class="btn btn-success text-white" href="{{ route('admin.detail.edit', $detail->id) }}">Edit</a>
@endif
@if (Auth::guard('admin')->user()->can('detail.delete'))

    @method('DELETE')
    <a type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this  detail?')">Delete</a>
</form>
                                        @endif

                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
     <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
</script>

<script>
    const showPasswordCheckboxes = document.querySelectorAll('.showPasswordCheckbox');

    showPasswordCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const targetId = this.dataset.target;
            const passwordSpan = document.getElementById(targetId);

            if (this.checked) {
                passwordSpan.textContent = passwordSpan.dataset.password;
            } else {
                passwordSpan.textContent = passwordSpan.dataset.masked;
            }
        });
    });
</script>
@endsection