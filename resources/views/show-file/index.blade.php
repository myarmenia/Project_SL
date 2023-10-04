@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/show-file/show-file.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.roles') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    ----
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('pagetitle.roles') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="app">
                        lorem ipsum lorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem
                        ipsumlorem ipsum lorem ipsumlorem ipsum Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Ipsam quasi praesentium possimus tempore aut obcaecati iusto ex eos at optio fuga
                        sapiente rerum, harum ducimus, voluptatem eius deserunt, nesciunt nihil illum quam magnam
                        voluptatibus assumenda magni velit? Quia, vero. Nesciunt temporibus consequatur sunt illo quod
                        necessitatibus labore aspernatur molestias, iste maxime, eius quia repellat accusantium rem
                        commodi. Quia blanditiis reprehenderit veniam eaque magni eligendi possimus excepturi quod
                        dolor accusantium, nemo facilis sit modi, placeat dolore? Harum sit provident laborum id!
                        Facilis vero, est repellat quod nobis, asperiores consectetur voluptates sunt temporibus vitae
                        corrupti, tenetur fugit illum nostrum? Ipsam, veritatis dicta.
                    </div>

                    <div id="modal">
                        <div class="modal_select" data-name="name">name:</div>
                        <div class="modal_select" data-name="ammunition">ammunition:</div>
                        <div class="modal_select" data-name="address">address:</div>
                    </div>

                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/show-file/show-file.js') }}"></script>
@endsection
@endsection
