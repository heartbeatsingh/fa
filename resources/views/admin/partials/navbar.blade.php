<nav>

    <ul>
        <li class="@yield('dashboard')">
            <a href="{{ url('/dashboard') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent"> Dashboard</span></a>
        </li>
        <li class="@yield('users')">
            <a href="{{ url('/users') }}"><i class="fa fa-users"></i> <span class="menu-item-parent"> Users</span></a>
        </li>
        <li class="@yield('pages')">
            <a href="{{ url('/pages') }}"><i class="fa fa-book"></i> <span class="menu-item-parent"> Pages</span></a>
        </li>
        <li class="@yield('qBar')">
            <a href="#"><i class="fa fa-question"></i> <span class="menu-item-parent"> Profile Questions</span></a>
            <ul>
                <li class="@yield('qList')">
                    <a href="{{ url('/questions') }}">Questions</a>
                </li>
                 <li class="@yield('qCreate')">
                    <a href="{{ url('/qusans/create') }}">Add New Question</a>
                </li>

               
            </ul>
        </li>

        <li class="">
            <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> <span class="menu-item-parent"> Logout</span></a>
        </li>


    </ul>
</nav>
