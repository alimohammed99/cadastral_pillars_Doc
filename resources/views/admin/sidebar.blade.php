<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
           <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/group-17.png') }}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="designation">Administrator</p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/redirect') }}">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('categories')}}">
                <span class="menu-title">Categories</span>
                <i class="icon-grid menu-icon"></i>
            </a>
        </li>
         <li class="nav-item">
             <a class="nav-link" href="{{url('pillars')}}">
                 <span class="menu-title">Pillars</span>
                 <i class="icon-grid menu-icon"></i>
             </a>
         </li>
        <li class="nav-item" style="margin-top:25%">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link" style="color: white; background:gray; padding:5px; text-decoration: none;">
                    <span class="menu-title" style="color:white">Logout</span>
                    <i class="icon-logout menu-icon" style="color:white; font-size:15px; padding-left:3px"></i>
                </button>
            </form>
        </li>



    </ul>
</nav>
