<div class="nav-top">
    @role('forsearch')
        <div class="toggle-sidebar-btn-wrapper"></div>
    @else
        <div class="toggle-sidebar-btn-wrapper">
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
    @endrole
    <div class="nav-top-right">
        <div> {{Auth::user()->first_name ?? ''}} {{Auth::user()->last_name ?? ''}}</div>
        <div class="dropdown">
            <a class="btn  dropdown-toggle " href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person " @style('font-size:22px')></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li> <a class="dropdown-item">   {{Auth::user()->username ?? ''}}  </a>    </li>
                <li><a class="dropdown-item">{{Auth::user()->roles[0]->name}}</a></li>
                <li> <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    {{ __('Logout') }}
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form></li>
            </ul>
        </div>
        <div class="bell-div">
            <a href="#"><i class="bi bi-bell"></i></a>
            <span class="bell-count">12</span>
        </div>
        <div class="dropdown">
            <a class="btn border-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('dropdown.lang-name') }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item"
                        href="{{ route(Route::currentRouteName(),array_merge(request()->route()->parameters(),['locale' => 'am'])) }}">Հայերեն</a>
                </li>
                <li><a class="dropdown-item"
                        href="{{ route(Route::currentRouteName(),array_merge(request()->route()->parameters(),['locale' => 'ru'])) }}">Русский</a>
                </li>
            </ul>
        </div>
    </div>
</div>
