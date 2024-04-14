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
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Company</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Company</h5>
                        <form class="row g-3" method="post" action="{{ route('companies.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="input1" class="form-label">Company Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Company Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="input1" class="form-label">Company Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Company Email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Company Image </label>
                                    <input class="form-control" type="file" id="logo" name="logo">
                                    @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="input1" class="form-label">Company Website</label>
                                    <input type="text" name="website" class="form-control" id="website"
                                        placeholder="Company Website">
                                    @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <img id="showImage" src="{{url('assets/images/no_image.jpg')}}" alt="Company Logo"
                                        class="rounded-circle p-1 bg-primary" width="80">
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Add Company">
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
        <script src="{{ asset('js/company.js?v='.time()) }}"></script>
    </div>
</body>

