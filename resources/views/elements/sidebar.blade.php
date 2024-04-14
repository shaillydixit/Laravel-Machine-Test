<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
           <a href="{{route('dashboard')}}"> <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon"></a>
        </div>
        <div>
		<a href="{{route('dashboard')}}">  <h4 class="logo-text">ADMIN </h4></a>
        </div>
    </div>
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{route('companies.index')}}">
                <div class="parent-icon"><i class='bx bx-buildings'></i>
                </div>
                <div class="menu-title">Companies</div>
            </a>
        </li>
        <li>
            <a href="{{route('employees.index')}}">
                <div class="parent-icon"><i class='bx bx-user-check'></i>
                </div>
                <div class="menu-title">Employees</div>
            </a>
        </li>
    </ul>
</div>
