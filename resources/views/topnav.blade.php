<!-- Top Bar Start -->
<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @foreach($userdetails as $user)
                    {{-- <button type="button" class="btn btn-outline-info waves-effect waves-light m-2">{{ $user->name }}</button> --}}
                    <span class="badge badge-outline-info p-2 m-2 fs-3 fw-1">{{ $user->name }}</span>
                    {{-- <span class="ml-1 nav-user-name hidden-sm">{{ $user->name }}</span> --}}
                    @endforeach

                    <img src="{{ asset('backend/assets/images/users/profile.png') }}" alt="profile-user" class="rounded-circle" />
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i data-feather="user"
                            class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="power"
                            class="align-self-center icon-xs icon-dual mr-1"></i> Logout</a>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-menu align-self-center topbar-icon">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </li>
            <li class="creat-btn">
                <div class="nav-link">
                    <span class="badge badge-soft-primary p-2">Welcome to {{$loggeduser}}</span>
                </div>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->
