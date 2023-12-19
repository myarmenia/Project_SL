<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"
                    title="{{ __('sidebar.open') }}"></i><span>{{ __('sidebar.open') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav5" class="nav-content collapse" data-bs-parent="#sidebar-nav">


                <li>
                    <a href="{{ route('open.page', 'bibliography') }}">
                        <i class="bi bi-journal-text"
                            title="{{ __('sidebar.bibliography') }}"></i><span>{{ __('sidebar.bibliography') }}</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('open.man') }}">
                        <i class="bi bi-person" title="{{ __('sidebar.man') }}"></i><span>{{ __('sidebar.man') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'sign') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.external_signs') }}"></i><span>{{ __('sidebar.external_signs') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'phone') }}">
                        <i class="bi bi-telephone"
                            title="{{ __('sidebar.phone') }}"></i><span>{{ __('sidebar.phone') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'email') }}">
                        <i class="bi bi-envelope-at"
                            title="{{ __('sidebar.email') }}"></i><span>{{ __('sidebar.email') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'weapon') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.weapon') }}"></i><span>{{ __('sidebar.weapon') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'car') }}">
                        <i class="bi bi-car-front"
                            title="{{ __('sidebar.car') }}"></i><span>{{ __('sidebar.car') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'address') }}">
                        <i class="bi bi-signpost"
                            title="{{ __('sidebar.address') }}"></i><span>{{ __('sidebar.address') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'work_activity') }}">
                        <i class="bi bi-person-workspace" title="{{ __('sidebar.work_activity') }}"></i><span>
                            {{ __('sidebar.work_activity') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'man_bean_country') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.man_beann_country') }}"></i><span>{{ __('sidebar.man_beann_country') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'objects_relation') }}">
                        <i class="bi bi-person-lines-fill"
                            title="{{ __('sidebar.objects_relation') }}"></i><span>{{ __('sidebar.objects_relation') }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'action') }}">
                        <i class="bi bi-person-gear"
                            title="{{ __('sidebar.action') }}"></i><span>{{ __('sidebar.action') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'event') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.event') }}"></i><span>{{ __('sidebar.event') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'signal') }}">
                        <i class="bi bi-telephone-outbound"
                            title="{{ __('sidebar.signal') }}"></i><span>{{ __('sidebar.signal') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'organization') }}">
                        <i class="bi bi-building"
                            title="{{ __('sidebar.organization') }}"></i><span>{{ __('sidebar.organization') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'keep_signal') }}">
                        <i class="bi bi-telephone-forward"
                            title="{{ __('sidebar.keep_signal') }}"></i><span>{{ __('sidebar.keep_signal') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'criminal_case') }}">
                        <i class="bi bi-person" title="{{ __('sidebar.criminal_case') }}"></i><span>
                            {{ __('sidebar.criminal_case') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'controll') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.control') }}"></i><span>{{ __('sidebar.control') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('open.page', 'mia_summary') }}">
                        <i class="bi bi-person"
                            title="{{ __('sidebar.mia_summary') }}"></i><span>{{ __('sidebar.mia_summary') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->

        <!-- search start -->
        {{-- @role('Admin|searcher') --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
                <i class="bi bi-search"
                    title="{{ __('content.search') }}"></i><span>{{ __('content.search') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav4" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('simple_search') }}">
                        <i class="bi bi-search"
                            title="{{ __('content.simple_search') }}"></i><span>{{ __('content.simple_search') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('advancedsearch') }}">
                        <i class="bi bi-search"
                            title="{{ __('content.complex_search') }}"></i><span>{{ __('content.complex_search') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('consistent_search') }}">
                        <i class="bi bi-search"
                            title="{{ __('content.template_search') }}"></i><span>{{ __('content.template_search') }}</span>
                    </a>
                </li>

                {{-- <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-search"
                                title="{{ __('content.file_search') }}"></i><span>{{ __('content.file_search') }}</span>
                        </a>
                    </li> --}}

                {{-- <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-search"
                                title="{{ __('sidebar.report_search_coloring') }}"></i><span>{{ __('sidebar.report_search_coloring') }}</span>
                        </a>
                    </li> --}}

                <li>
                    <a href="{{ route('table-content.index') }}">
                        <i class="bi bi-search"
                            title="{{ __('content.search_by_table_data') }}"></i><span>{{ __('content.search_by_table_data') }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('search_file') }}">
                        <i class="bi bi-file-earmark"
                            title="{{ __('content.search_file ') }}"></i><span>{{ __('content.search_file') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- @endrole --}}
        <!-- search end -->

        <!-- add material start-->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
                <i class="bi bi-plus-square"
                    title="{{ __('content.addTo') }}"></i><span>{{ __('content.addTo') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav3" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>

                    <a href="{{ route('bibliography.create') }}">

                        <i i class="bi bi-journal-text"
                            title="Նյութեր"></i><span>{{ __('sidebar.materials') }}</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- add material end -->

        <!-- dictionry start -->
        {{-- @role('Admin') --}}

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-journals"
                    title="{{ __('sidebar.dictionaries') }}"></i><span>{{ __('sidebar.dictionaries') }}</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                @canany(['agency-list', 'agency-create', 'agency-edit', 'agency-delete'])
                    <li>

                        <a href="{{ route('dictionary.pages', 'agency') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.agency') }}"></i><span>{{ __('sidebar.agency') }}</span>
                        </a>
                    </li>
                @endcan

                @canany(['doc_category-list', 'doc_category-create', 'doc_category-edit', 'doc_category-delete'])
                    <li>

                        <a href="{{ route('dictionary.pages', 'doc_category') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.doc_category') }}"></i><span>{{ __('sidebar.doc_category') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['access_level-list', 'access_level-create', 'access_level-edit', 'access_level-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'access_level') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.access_level') }}"></i><span>{{ __('sidebar.access_level') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['gender-list', 'gender-create', 'gender-edit', 'gender-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'gender') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.gender') }}"></i><span>{{ __('sidebar.gender') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['nation-list', 'nation-create', 'nation-edit', 'nation-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'nation') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.nation') }}"></i><span>{{ __('sidebar.nation') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['country-list', 'country-create', 'country-edit', 'country-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'country') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.country') }}"></i><span>{{ __('sidebar.country') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['country_ate-list', 'country_ate-create', 'country_ate-edit', 'country_ate-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'country_ate') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.country_ate') }}"></i><span>{{ __('sidebar.country_ate') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['language-list', 'language-create', 'language-edit', 'language-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'language') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.language') }}"></i><span>{{ __('sidebar.language') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['religion-list', 'religion-create', 'religion-edit', 'religion-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'religion') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.religion') }}"></i><span>{{ __('sidebar.religion') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['region-list', 'region-create', 'region-edit', 'region-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'region') }}">
                            <i class="bi bi-journal-text"
                                title="{{ __('sidebar.region') }}"></i><span>{{ __('sidebar.region') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['street-list', 'street-create', 'street-edit', 'street-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'street') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.street') }}"></i><span>{{ __('sidebar.street') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['locality-list', 'locality-create', 'locality-edit', 'locality-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'locality') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.locality') }}"></i><span>{{ __('sidebar.locality') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['operation_category-list', 'operation_category-create', 'operation_category-edit',
                    'operation_category-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'operation_category') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.operation_category') }}"></i><span>{{ __('sidebar.operation_category') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['education-list', 'education-create', 'education-edit', 'education-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'education') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.education') }}"></i><span>{{ __('sidebar.education') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['party-list', 'party-create', 'party-edit', 'party-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'party') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.party') }}"></i><span>{{ __('sidebar.party') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['relation_type-list', 'relation_type-create', 'relation_type-edit', 'relation_type-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'relation_type') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.relation_type') }}"></i><span>{{ __('sidebar.relation_type') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['sign-list', 'sign-create', 'sign-edit', 'sign-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'sign') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.sign') }}"></i><span>{{ __('sidebar.sign') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['character-list', 'character-create', 'character-edit', 'character-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'character') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.character') }}"></i><span>{{ __('sidebar.character') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['car_category-list', 'car_category-create', 'car_category-edit', 'car_category-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'car_category') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.car_category') }}"></i><span>{{ __('sidebar.car_category') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['car_mark-list', 'car_mark-create', 'car_mark-edit', 'car_mark-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'car_mark') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.car_mark') }}"></i><span>{{ __('sidebar.car_mark') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['goal-list', 'goal-create', 'goal-edit', 'goal-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'goal') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.goal') }}"></i><span>{{ __('sidebar.goal') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['action_goal-list', 'action_goal-create', 'action_goal-edit', 'action_goal-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'action_goal') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.action_goal') }}"></i><span>{{ __('sidebar.action_goal') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['action_qualification-list', 'action_qualification-create', 'action_qualification-edit',
                    'action_qualification-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'action_qualification') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.action_qualification') }}"></i><span>{{ __('sidebar.action_qualification') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['duration-list', 'duration-create', 'duration-edit', 'duration-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'duration') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.duration') }}"></i><span>{{ __('sidebar.duration') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['terms-list', 'terms-create', 'terms-edit', 'terms-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'terms') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.terms') }}"></i><span>{{ __('sidebar.terms') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['aftermath-list', 'aftermath-create', 'aftermath-edit', 'aftermath-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'aftermath') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.aftermath') }}"></i><span>{{ __('sidebar.aftermath') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['event_qualification-list', 'event_qualification-create', 'event_qualification-edit',
                    'event_qualification-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'event_qualification') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.event_qualification') }}"></i><span>{{ __('sidebar.event_qualification') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['worker_post-list', 'worker_post-create', 'worker_post-edit', 'worker_post-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'worker_post') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.worker_post') }}"></i><span>{{ __('sidebar.worker_post') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['organization_category-list', 'organization_category-create', 'organization_category-edit',
                    'organization_category-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'organization_category') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.organization_category') }}"></i><span>{{ __('sidebar.organization_category') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['signal_qualification-list', 'signal_qualification-create', 'signal_qualification-edit',
                    'signal_qualification-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'signal_qualification') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.signal_qualification') }}"></i><span>{{ __('sidebar.signal_qualification') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['resource-list', 'resource-create', 'resource-edit', 'resource-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'resource') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.resource') }}"></i><span>{{ __('sidebar.resource') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['signal_result-list', 'signal_result-create', 'signal_result-edit', 'signal_result-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'signal_result') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.signal_result') }}"></i><span>{{ __('sidebar.signal_result') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['control_result-list', 'control_result-create', 'control_result-edit', 'control_result-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'control_result') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.control_result') }}"></i><span>{{ __('sidebar.control_result') }}</span>
                        </a>
                    </li>
                @endcan
                @canany(['taken_measure-list', 'taken_measure-create', 'taken_measure-edit', 'taken_measure-delete'])
                    <li>
                        <a href="{{ route('dictionary.pages', 'taken_measure') }}">
                            <i i class="bi bi-journal-text"
                                title="{{ __('sidebar.taken_measure') }}"></i><span>{{ __('sidebar.taken_measure') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        {{-- @endrole --}}
        <!-- dictionry end -->

        <!-- admin start -->
        @role('Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"
                        title="{{ __('content.type_admin') }}"></i><span>{{ __('content.type_admin') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>

                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-person"
                                title="{{ __('content.user_list ') }}"></i><span>{{ __('content.user_list') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="bi bi-person-gear"
                                title="{{ __('sidebar.roles') }}"></i><span>{{ __('sidebar.roles') }}</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('loging.index') }}">
                            <i class="bi bi-card-text"
                                title="{{ __('content.logging ') }}"></i><span>{{ __('content.logging') }}</span>
                        </a>
                    </li>



                    {{-- <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-card-text"
                                title="{{ __('content.mysql_import ') }}"></i><span>{{ __('content.mysql_import') }}</span>
                        </a>
                    </li> --}}


                    <li>

                        <a href="{{ route('optimization.page', 'bibliography') }}">

                            <i class="bi bi-card-text"
                                title="{{ __('content.optimization ') }}"></i><span>{{ __('content.optimization') }}</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('fusion.index') }}">
                            <i class="bi bi-journals"></i><span>{{ __('content.fusion') }}</span>

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.index') }}">
                            <i class="bi bi-search"
                                title="{{ __('content.report_search') }}"></i><span>{{ __('content.report_search') }}</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li>
                <a class="nav-link collapsed" href="{{ route('translate.index') }}">
                    <i class="bi bi-translate" title="{{ __('content.translation ') }}"></i>
                    <span>{{ __('sidebar.learning_systems') }}</span>
                </a>
            </li>
        @endrole

        <!-- admin end -->

        <!-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('table-content.*') ? '' : ' collapsed' }}" href="{{ route('table-content.index') }}">
                <i  class="bi bi-person-gear" title="{{ __('sidebar.file-upload') }}"></i><span>{{ __('sidebar.file-upload') }}</span>
            </a>
        </li> -->
    </ul>
</aside>
