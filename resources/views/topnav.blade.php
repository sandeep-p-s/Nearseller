<!-- Top Bar Start -->
<div class="topbar">
    <!-- Navbar -->
    {{-- <nav class="navbar-custom"  style="background-color: {{ isset($allsectdetails->colorpicks) ? $allsectdetails->colorpicks : '' }}"> --}}
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    @foreach ($userdetails as $user)
                        {{-- <button type="button" class="btn btn-outline-info waves-effect waves-light m-2">{{ $user->name }}</button> --}}
                        <span class="badge badge-outline-info p-2 m-2 fs-3 fw-1">{{ $user->name }}</span>
                        {{-- <span class="ml-1 nav-user-name hidden-sm">{{ $user->name }}</span> --}}
                    @endforeach

                    <img src="{{ asset(isset($allsectdetails->shoplogo) ? $allsectdetails->shoplogo : 'backend/assets/images/users/profile.png') }}"
                        alt="profile-user" class="rounded-circle" />
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" href="#"><i data-feather="user"
                            class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="power"
                            class="align-self-center icon-xs icon-dual mr-1"></i> Logout</a>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile" style="background-color: #f0f8ff">
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
                    <span class="badge badge-soft-primary p-2">Welcome to {{ $loggeduser }}</span>
                </div>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->


{{-- <script>
    setTimeout(function() {
        location.reload(); // Refresh the page
    }, 60000); // 60,000 milliseconds = 1 minute
</script> --}}

{{-- <script>
    var idleTimeout = 60000; // 60,000 milliseconds = 1 minute
    var timeoutId;

    // Function to refresh the page
    function refreshPage() {
        location.reload(); // Refresh the page
    }
    // Function to start the idle timer
    function startIdleTimer() {
        // Clear any existing timer (if any)
        clearTimeout(timeoutId);
        // Set a new timer to refresh the page after the idle timeout
        timeoutId = setTimeout(refreshPage, idleTimeout);
    }

    // Start the idle timer when the page loads
    startIdleTimer();
    // Listen for user activity (e.g., mousemove or keydown) to reset the timer
    document.addEventListener("mousemove", startIdleTimer);
    document.addEventListener("keydown", startIdleTimer);
</script> --}}


{{-- <script>
    // Set the time interval (in milliseconds) for the page refresh
    var refreshInterval = 60000; // 60,000 milliseconds = 1 minute

    // Function to refresh the page
    function refreshPage() {
        location.reload(); // Refresh the page
    }

    // Start a timer to refresh the page after the specified interval
    var refreshTimer = setTimeout(refreshPage, refreshInterval);

    // Check if there are open popups when the page is about to refresh
    window.addEventListener("beforeunload", function (event) {
        // If there are open popups, prevent the page refresh
        if (areThereOpenPopups()) {
            event.returnValue = "You have unsaved changes. Are you sure you want to refresh the page?";
        } else {
            // Clear the timer to prevent the page from refreshing
            clearTimeout(refreshTimer);
        }
    });

    // Function to check if there are open popups (customize this function as needed)
    function areThereOpenPopups() {
        // Add your logic here to check for open popups
        // Return true if there are open popups, false otherwise
        return false; // Replace with your logic
    }
    </script> --}}
