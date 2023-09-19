<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('table-content.*') ? '' : ' collapsed' }}" href="{{ route('table-content.index')}}">
                <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.file-upload')}}</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('roles.*') ? '' : ' collapsed' }}" href="{{ route('roles.index')}}">
                <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.roles')}}</span>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide" title="Կարգավորումներ"></i><span>Կարգավորումներ</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-person" title="Օգտատերեր"></i><span>Օգտատերեր</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-person-gear" title="Դերեր"></i><span>Դերեր</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide" title="Տվյալներրի մուտք"></i><span>Տվյալներրի մուտք</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-person" title="Անձեր"></i><span>Անձեր</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#">
                <i class="bi bi-card-checklist" title="Տվյալներրի մուտքագրում Ֆայլերի միջոցով"></i><span>Տվյալներրի
                    մուտքագրում</span>
            </a>
        </li>

        <!-- End file upload Page Nav -->
    </ul>
</aside>
