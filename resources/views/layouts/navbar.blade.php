@inject('Login', 'App\Models\Login')
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow" style="position: static;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <h1 class="h3 mb-0 text-gray-800">Temperature & Humidity Monitoring</h1>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li id="clock" class="nav-item border-1-primary mt-4 d-none d-lg-inline"></li>

        <!-- This script will update the time and date on the webpage -->
        <script>
            function updateClock() {
                // Get the current time and date
                var currentTime = new Date();

                // Get the hours, minutes, and seconds from the current time
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();

                // Convert hours, minutes, and seconds to strings and add leading zeros if necessary
                hours = (hours < 10 ? "0" : "") + hours;
                minutes = (minutes < 10 ? "0" : "") + minutes;
                seconds = (seconds < 10 ? "0" : "") + seconds;

                // Get the day, month, and year from the current time
                var day = currentTime.getDate();
                var month = currentTime.getMonth() + 1; // January is month 0
                var year = currentTime.getFullYear();

                // Convert day, month, and year to strings and add leading zeros if necessary
                day = (day < 10 ? "0" : "") + day;
                month = (month < 10 ? "0" : "") + month;

                // Use the innerHTML property to update the time and date on the webpage
                document.getElementById("clock").innerHTML =
                    day + "/" + month + "/" + year + " " + hours + ":" + minutes + ":" + seconds;
            }

            // Call the updateClock function every 1000 milliseconds (1 second)
            setInterval(updateClock, 1000);
        </script>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">{{$username}} </span>
                <img class="img-profile rounded-circle" src="{{asset ('assets/img/undraw_profile.svg')}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ganti Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda Akan Logout</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{route ('logout')}}">Logout</a>
            </div>
        </div>
    </div>
</div>