@extends('layouts.default')
@section('content')
@include('elements.top_css')

<body>
    <div class="wrapper">
        @include('elements.header')
        @include('elements.sidebar')
        <div class="page-wrapper">
            <div class="page-content">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <a href="{{route('employees.index')}}" class="btn btn-primary">Back </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Employee</h5>
                        <form class="row g-3" method="post" action="{{ route('employees.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-1">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select name="company_id" id="company_id" class="form-select">
                                        <option value="">Select Company</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label for="input1" class="form-label">Employee First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                        placeholder="Employee First Name">
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="input1" class="form-label">Employee Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                        placeholder="Employee Last Name">
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="input1" class="form-label">Employee Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Employee Email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label for="input1" class="form-label">Employee Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Employee Phone">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-5">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Add Employee">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('elements.footer')
        @include('elements.bottom_js')
    </div>
</body>
