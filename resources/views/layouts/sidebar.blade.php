<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('table-content.*') ? '' : ' collapsed' }}" href="{{ route('table-content.index')}}">
                <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.file-upload')}}</span>
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
                    <a href="{{ route('roles.index')}}" >
                        <i class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.roles')}}</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('roles.*') ? '' : ' collapsed' }}" >
                        <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.roles')}}</span>
                    </a>

                </li> -->
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

        <!-- Bibliography -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journals" title="Բառարաններ"></i><span>Բառարաններ</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կառավարման մարմիններ"></i><span>Կառավարման մարմիններ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Փաստաթղթի կատեգորիա"></i><span>Փաստաթղթի կատեգորիա</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Մուտքի մակարդակ"></i><span>Մուտքի մակարդակ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Սեռ"></i><span>Սեռ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ազգություն"></i><span>Ազգություն</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Երկիր"></i><span>Երկիր</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Երկիր, ՎՏՄ"></i><span>Երկիր, ՎՏՄ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Լեզուներ"></i><span>Լեզուներ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կրոն"></i><span>Կրոն</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Մարզ (տեղական)"></i><span>Մարզ (տեղական)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Փողոց (տեղական)"></i><span>Փողոց (տեղական)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Բնակավայր (տեղական)"></i><span>Բնակավայր (տեղական)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Օպերատիվ կատեգորիա"></i><span>Օպերատիվ կատեգորիա</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կրթություն"></i><span>Կրթություն</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կուսակցական պատկանելություն"></i><span>Կուսակցական պատկանելություն</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կապի բնույթը"></i><span>Կապի բնույթը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Արտաքին նշաններ"></i><span>Արտաքին նշաններ</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Սեփականության բնույթը"></i><span>Սեփականության բնույթը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ավտոմեքենայի կատեգորիան"></i><span>Ավտոմեքենայի կատեգորիան</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Սեփականության բնույթը"></i><span>Ավտոմեքենայի կատեգորիան</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</aside>
