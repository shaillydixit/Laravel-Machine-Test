<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu">
            <a type="button" class="btn btn-success" href="{{route('dashboard')}}">Dashboard</a>
            <a type="button" class="btn btn-success" href="{{route('companies.index')}}">Company</a>
            <a type="button" class="btn btn-success" href="{{route('employees.index')}}">Employee</a>
            </div>
            <div class="top-menu ms-auto">
            </div>
            @php
            $id = Illuminate\Support\Facades\Auth::user()->id;
            $profileData = App\Models\User::find($id);
            @endphp
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('assets/images/profile.jpg')}}" class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{$profileData->name}}</p>
                        <p class="designattion mb-0">{{$profileData->email}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{route('admin.logout')}}"><i
                                class="bx bx-log-out-circle"></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
