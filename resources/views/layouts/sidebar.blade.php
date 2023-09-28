<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('table-content.*') ? '' : ' collapsed' }}" href="{{ route('table-content.index')}}">
                <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.file-upload')}}</span>
            </a>

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

        

        <!-- dictionry start -->
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
                        <i i class="bi bi-journal-text" title="Ավտոմեքենայի մոդելը"></i><span>Ավտոմեքենայի մոդելը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Մուտքի նպատակը, դրդապատճառը, պատճառը"></i><span>Մուտքի նպատակը, դրդապատճառը, պատճառը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Գործողության նպատակը"></i><span>Գործողության նպատակը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Փաստի որակավորում(գործողությունների աղյուսակ)"></i><span>Փաստի որակավորում(գործողությունների աղյուսակ)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Գործողության տևեղությունը"></i><span>Գործողության տևեղությունը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Գործողության կատարման պայմանները"></i><span>Գործողության կատարման պայմանները</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Հետևանք"></i><span>Հետևանք</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Իրադարձության որակավորումպհպ"></i><span>Իրադարձության որակավորում</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Օ/ա պաշտոնը"></i><span>Օ/ա պաշտոնը</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կազմակերպության կատեգորիա"></i><span>Կազմակերպության կատեգորիա</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ահազանգի երանգավորում"></i><span>Ահազանգի երանգավորում</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ներգրաված ուժերը և միջոցները"></i><span>Ներգրաված ուժերը և միջոցները</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ստուգման արթյունքները (Ահազանգ)"></i><span>Ստուգման արթյունքները (Ահազանգ)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Կատարման արդյունքները(վերահսկում)"></i><span>Կատարման արդյունքները(վերահսկում)</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i i class="bi bi-journal-text" title="Ձեռնարկված միջոցները"></i><span>Ձեռնարկված միջոցները</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- dictionry end -->

        <!-- admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide" title="Ադմինիստրատոր"></i><span>Ադմինիստրատոր</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-person" title="Գործածողների Ցուցակ"></i><span>Գործածողների Ցուցակ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index')}}" >
                        <i class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.roles')}}</span>
                    </a>
                </li>

                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-card-text" title="Գրառում"></i><span>Գրառում</span>
                    </a>
                </li>




                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('roles.*') ? '' : ' collapsed' }}" >
                        <i  class="bi bi-person-gear" title="{{ __('sidebar.roles')}}"></i><span>{{ __('sidebar.roles')}}</span>
                    </a>

                </li> -->
            </ul>
        </li>
    </ul>
</aside>
