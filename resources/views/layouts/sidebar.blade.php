{{-- 
/**
 * ==================================================================================================
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
 * ==================================================================================================
 */
--}}

<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{route('part-details.index')}}" title="Laravel-ACL">
                <span class="brand-name text-truncate">My App</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">

            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="">
                    <a class="sidenav-item-link" href="{{route('part-details.index')}}">
                        <i class="mdi mdi-city-variant-outline"></i>
                        <span class="nav-text">Parts</span>
                    </a>
                </li>
                <li class="">
                    <a class="sidenav-item-link" href="{{route('met-requirements.index')}}">
                        <i class="mdi mdi-city-variant-outline"></i>
                        <span class="nav-text">Met Req</span>
                    </a>
                </li>
                <li class="">
                    <form action="{{route('logout')}}" id="logout-sidebar" method="post">
                        @csrf
                    </form>
                    <a class="sidenav-item-link" href="javascript:$('#logout-sidebar').submit();" method="post">
                        <i class="mdi mdi-logout"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</aside>