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
                                <li class="breadcrumb-item active" aria-current="page">Update Company</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Update Company</h5>
                        
                        <!-- <form class="row g-3" name="edit_company_form" id="edit_company_form" class="edit_company_form"> -->
                        <form class="row g-3" 
                        action="{{ route('companies.update', $companyData->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="id" name="id"
                                value="{{ !empty($companyData) ? $companyData->id : '' }}">

                            <div class="col-md-6">
                                <label for="name" class="form-label">Company Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ !empty($companyData) ? $companyData->name : '' }}"
                                    placeholder="Company Name" title="Enter Company Name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Company Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ !empty($companyData) ? $companyData->email : '' }}"
                                    placeholder="Company Email" >
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Company Image</label>
                                <input class="form-control" type="file" id="logo" name="logo">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="website" class="form-label">Company Website</label>
                                <input type="text" name="website" class="form-control" id="website"
                                    value="{{ !empty($companyData) ? $companyData->website : '' }}"
                                    placeholder="Company Website">
                                    @error('website')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <img id="showImage"
                                    src="{{ !empty($companyData) ? url('/storage/files/company/'.$companyData->logo) : url('assets/images/no_image.jpg') }}"
                                    alt="Company Logo" class="rounded-circle p-1 bg-primary" width="80">
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" id="update_btn_company" class="btn btn-primary px-4">Update
                                        Changes</button>
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

