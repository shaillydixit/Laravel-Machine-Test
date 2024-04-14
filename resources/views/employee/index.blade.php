@extends('layouts.default')
@section('content')
@include('elements.top_css')

<body>
    <div class="wrapper">
        @include('elements.header')
        @include('elements.sidebar')
        <div class="page-wrapper">
            <div class="page-content">
                <div class="page-content">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                                class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">All Employees</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{route('employees.create')}}" class="btn btn-primary px-5">Add Employee </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="employee_datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th> Company </th>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Phone </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('elements.footer')
            @include('elements.bottom_js')
            <script src="{{ asset('js/employee.js?v='.time()) }}"></script>

        </div>
     
</body>
