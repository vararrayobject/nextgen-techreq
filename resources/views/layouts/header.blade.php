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

<div class="preloader"></div>
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block"></div>

        <div class="navbar-right pull-right">
            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{asset('assets/img/user/user.png')}}" class="user-image" alt="User Image" />
                        <span class="d-none d-lg-inline-block">{{ ucfirst(auth()->user()->name) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{asset('assets/img/user/user.png')}}" class="img-circle" alt="User Image" />
                            <div class="d-inline-block">
                                {{ ucfirst(auth()->user()->name) }} <small
                                    class="pt-1">{{ auth()->user()->email }}</small>
                            </div>
                        </li>

                        <li class="dropdown-footer">
                            <form action="{{route('logout')}}" id="logout" method="post">
                                @csrf
                                <a href="javascript:$('#logout').submit();"> <i class="mdi mdi-logout"></i> Log Out
                                </a>
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


</header>