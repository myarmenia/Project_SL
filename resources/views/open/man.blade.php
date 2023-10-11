@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">
                        Տվյալների մուտքագրում ֆայլերի միջոցով
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- add Perrson Table -->

    <section class="section">
        <div class="col">
            <div class="card">
                <!-- global button -->
                <div class="button-clear-filter">
                    <button class="btn btn-secondary" id="clear_button">Մաքրել բոլորը</button>
                </div>
                <!-- global button end -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div">
                        <table id="resizeMe" class="person_table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">Id <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="Ազգանուն">
                                        Ազգանուն <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Անուն <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Հայրանուն <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex" title="">
                                        Ծննդյան տարեթիվ(օր) <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex"
                                        title="Ծննդյան տարեթիվ(օր)">Ծննդյան տարեթիվ(ամիս) <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex" title="">
                                        Ծննդյան տարեթիվ(տարի) <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Անուն Ազգանուն Հայրանուն <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ծննդավայր (երկիր ՎՏՄ) <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ծննդավայր (շրջան) <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ծննդավայր (բնակավայր) <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ծննդյան մոտավոր տարեթիվ <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Անձնագրի համարը <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Սեռ <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ազգություն<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Քաղաքացիություն<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Լեզուների իմացություն<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ուշադրություն!<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Լրացուցիչ տեղեկություններ անձի վերաբերյալ <i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Կրոն <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Զբաղմունք <i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Հետախուզում իրականացնող երկիրը<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Անձի օպերատիվ կատեգորիա<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                        title="">Հետախուզումը հայտարարվել է<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                        title="">ՀՀ տարածք մուտք գործելու վերահսկման սկիզբ<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex-date"
                                        title="">ՀՀ տարածք մուտք գործելու վերահսկման ավարտ<i class="fa fa-filter"
                                            aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Կրթություն։ Գիտական աստիճան, կոչում<i class="fa fa-filter" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Կուսակցական պատկանելիություն<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Ծածկանուն (մականուն)<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Անձի նկատմամբ բացվել է ՕՀԳ<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="standart-complex" title="">
                                        Տեղեկատվության աղբյուր<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th class="filter-th" data-sort="null" data-type="filter-complex" title="">
                                        Ֆոտո<i class="fa fa-filter" aria-hidden="true"></i></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Garik</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Marat</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Ահազանգ</span></td>
                                    <td><span class="announcement_modal_span" data-bs-toggle="modal"
                                            data-bs-target="#announcement_modal">Տվյալների չտրամադրում</span></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td><button>d</button></td>
                                    <td>26409</td>
                                    <td>Xazaryan</td>
                                    <td>Artur</td>
                                    <td>Hrachi</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>1986</td>
                                    <td>Artur Hrachi Xazaryan</td>
                                    <td>RD</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>


                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    <div>
        <!-- add Person table end -->

        <!-- large modal blog -->
        <div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLgLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="exampleModalLgLabel">Ավելացնել նոր գրառում</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="large-modalBlock">
                            <div class="mb-3 announcement-input-block">
                                <label for="start_of_announcement" class="form-label">Հայտարարման սկիզբ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="start_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="end_of_announcement" class="form-label">Հայտարարման ավարտ</label>
                                <input style="position: relative;" type="date" class="form-control"
                                    id="end_of_announcement">
                            </div>
                            <div class="mb-3 announcement-input-block">
                                <label for="exampleFormControlTextarea1" class="form-label">Նկարագրություն</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-button">
                            <button class='btn btn-primary my-class-sub' data-bs-dismiss="modal">Ավելացնել</button>
                        </div>

                    </div>
                </div>
            </div>



        @section('js-scripts')
            <script src='{{ asset('assets/js/main/table.js') }}'></script>
        @endsection

    @endsection
