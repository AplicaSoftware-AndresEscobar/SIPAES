 <aside class="main-sidebar sidebar-light-danger elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('home') }}" class="brand-link bg-danger">
         <img src="{{ asset('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('assets/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('profile') }}" class="d-block">{{ current_user_information()->fullname }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar nav-child-indent nav-collapse-hide-child flex-column"
                 data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                 @foreach (config('template.sidebar-menu') as $item)
                     <li class="nav-item">
                         <a href="{{ url($item['url']) }}" class="nav-link {{ routeIsActived($item['url']) }}">
                             @if (isset($item['icon']) && $item['icon'])
                                 <i class="{{ $item['icon'] }}"></i>
                             @endif
                             <p>{{ $item['name'] }}</p>
                             @if (isset($item['submenu']) && $item['submenu'])
                                 <span class="right fas fa-angle-left"></span>
                             @endif
                         </a>
                         @if (isset($item['submenu']) && $item['submenu'])
                             <ul class="nav nav-treeview">
                                 @foreach ($item['submenu'] as $subItem)
                                     <li class="nav-item">
                                         <a href="{{ $subItem['url'] }}" class="nav-link">
                                             @if (isset($subItem['icon']) && $subItem['icon'])
                                                 <i class="{{ $subItem['icon'] }}"></i>
                                             @endif
                                             <p>{{ $subItem['name'] }}</p>
                                             @if (isset($subItem['submenu']) && $subItem['submenu'])
                                                 <span class="right fas fa-angle-left"></span>
                                             @endif
                                         </a>
                                         @if (isset($subItem['submenu']) && $subItem['submenu'])
                                             <ul class="nav nav-treeview">
                                                 @foreach ($subItem['submenu'] as $subItemTwo)
                                                     <li>
                                                         <a class="nav-link" href="{{ $subItemTwo['url'] }}">
                                                             @if (isset($subItemTwo['icon']) && $subItemTwo['icon'])
                                                                 <i class="{{ $subItemTwo['icon'] }}"></i>
                                                             @endif
                                                             <p>{{ $subItemTwo['name'] }}</p>
                                                         </a>
                                                     </li>
                                                 @endforeach
                                             </ul>
                                         @endif
                                     </li>
                                 @endforeach
                             </ul>
                         @endif
                     </li>
                 @endforeach
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
