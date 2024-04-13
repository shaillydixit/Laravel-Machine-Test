@extends('layouts.default')
@section('content')
@include('elements.top_css')
<body>
    <div class="wrapper">
        @include('elements.header')
        @include('elements.sidebar')
        <div class="page-wrapper">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0 text-secondary">Total Employees</h6>
                                        <h4 class="my-1 text-success">34</h4>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class='bx  bxs-group'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0 text-secondary">Total Companies</h6>
                                        <h4 class="my-1 text-warning">8</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                            class='bx bxs-buildings'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        @include('elements.footer')
        @include('elements.bottom_js')
    </div>
</body>
