 <!-- sidebar menu -->
 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
     <div class="menu_section">
         <h3>General</h3>
         <ul class="nav side-menu">
             @foreach (config('template.sidebar-menu') as $item)
                 <li>
                     <a href="{{ url($item['url']) }}">
                         <i class="{{ $item['icon'] }}"></i>{{ $item['name'] }}
                         @if (isset($item['submenu']) && $item['submenu'])
                             <span class="fa fa-chevron-down"></span>
                         @endif
                     </a>
                     @if (isset($item['submenu']) && $item['submenu'])
                         <ul class="nav child_menu">
                             @foreach ($item['submenu'] as $subItem)
                                 <li>
                                     <a href="{{ $subItem['url'] }}">{{ $subItem['name'] }}
                                         @if (isset($subItem['submenu']) && $subItem['submenu'])
                                             <span class="fa fa-chevron-down"></span>
                                         @endif
                                     </a>
                                     @if (isset($subItem['submenu']) && $subItem['submenu'])
                                         <ul class="nav child_menu">
                                             @foreach ($subItem['submenu'] as $subItemTwo)
                                                 <li><a href="{{ $subItemTwo['url'] }}">{{ $subItemTwo['name'] }}</a>
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
     </div>
 </div>
 <!-- /sidebar menu -->
