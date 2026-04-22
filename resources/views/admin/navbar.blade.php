 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
     <div class="navbar-brand-wrapper d-flex align-items-center">

     </div>
     <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
         <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Admin Dashboard</h5>
         <ul class="navbar-nav navbar-nav-right ml-auto">
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <button type="submit" class="dropdown-item" style="border:1px solid red">
                     <i class="dropdown-item-icon icon-power text-primary" style="margin-right:5px"></i>Logout
                 </button>
             </form>
         </ul>
         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
             id="sidebarToggle">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                 class="bi bi-list" viewBox="0 0 16 16">
                 <path fill-rule="evenodd"
                     d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
             </svg>
         </button>
     </div>
 </nav>
