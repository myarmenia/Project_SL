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
                <i class="bi bi-search" title="{{ __('sidebar.search')}}"></i><span>{{ __('sidebar.search')}}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.simple_search')}}"></i><span>{{ __('sidebar.simple_search')}}</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.complex_search')}}"></i><span>{{ __('sidebar.complex_search')}}</span>
                    </a>
                </li>


                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.template_search')}}"></i><span>{{ __('sidebar.template_search')}}</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.file_search')}}"></i><span>{{ __('sidebar.file_search')}}</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.report_search_signal')}}"></i><span>{{ __('sidebar.report_search_signal')}}</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-search" title="{{ __('sidebar.report_painting')}}"></i><span>{{ __('sidebar.report_painting')}}</span>
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
