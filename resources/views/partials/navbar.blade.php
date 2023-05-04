 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         {{-- <li class="nav-item d-none d-sm-inline-block">
             <a href="../../index3.html" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">Contact</a>
         </li> --}}
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Navbar Search -->
         @include('partials.navbar_search')
         <!-- ./Navbar Search -->

         <!-- Messages Dropdown Menu -->
         @include('partials.messages')
         <!-- ./Messages Dropdown Menu -->

         <!-- Notifications Dropdown Menu -->
         @include('partials.notifications')
         <!-- ./Notifications Dropdown Menu -->

         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                 <i class="fas fa-th-large"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 <i class="fas fa-sign-out-alt"></i>
             </a>

             <form action="{{ route('logout') }}" method="post" id="logout-form">@csrf</form>
         </li>
     </ul>
 </nav>
