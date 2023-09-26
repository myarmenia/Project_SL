
@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/checked_file_data/index.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{__('sidebar.roles')}}</h1>
            <nav>
                <ol class="breadcrumb">
                  ----
                    <li class="breadcrumb-item"><a href="index.html">{{__('pagetitle.main')}}</a></li>
                    <li class="breadcrumb-item active">{{__('pagetitle.roles')}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <div class="flex justify-between items-center">
                <h5 class="card-title">Table 1</h5>
                <button
                  data-bs-toggle="modal"
                  data-bs-target="#fullscreenModal"
                  class="btn btn-secondary h-fit w-fit"
                >
                  add new
                </button>
              </div>
              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">confirmed</th>
                    <th scope="col">procent</th>
                    <th scope="col">name</th>
                    <th scope="col">surname</th>
                    <th scope="col">patronymic</th>
                    <th scope="col">birthday</th>
                    <th scope="col">address</th>
                    <th scope="col">desc</th>
                    <th scope="col" class="td-xs">File</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr class="start">
                    <td scope="row">1</td>

                    <td scope="row" class="td-icon">
                      <i class="bi icon icon-y icon-base bi-check"></i>
                    </td>
                    <td scope="row" class="td-icon">
                      
                      <!-- <i class="bi icon icon-sm bi-trash"></i> -->
                    </td>


                    <td contenteditable="true" spellcheck="false">qajik</td>
                    <td contenteditable="true" spellcheck="false">qajikyan</td>
                    <td contenteditable="true" spellcheck="false">haruti</td>
                    <td contenteditable="true" spellcheck="false">22/07/99</td>

                    <td contenteditable="true" spellcheck="false">Gayi poxota</td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      </div>
                    </td>

                    <td>
                      <div class="file-box-title">
                        <a target="blank" href="#">
                          <i class="bi bi-file-earmark-arrow-down-fill"></i>
                          <span>file name</span>
                        </a>
                      </div>
                    </td>
                  </tr>
                 
                  <tr>
                    <td scope="row"></td>

                    <td scope="row" class="td-icon">
                      <div class="form-check icon icon-sm">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </td>
                    <td scope="row" class="td-icon"></td>
                    <td contenteditable="true" spellcheck="false">Bridie 1</td>
                    <td contenteditable="true" spellcheck="false">Bridie 2</td>
                    <td contenteditable="true" spellcheck="false">Bridie 3</td>
                    <td contenteditable="true" spellcheck="false">Bridie 4</td>
                    <td contenteditable="true" spellcheck="false">Bridie 5</td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      </div>
                    </td>

                    <td>
                      <div class="file-box-title">
                        <a target="blank" href="#">
                          <i class="bi bi-file-earmark-arrow-down-fill"></i>
                          <span>file name</span>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td scope="row"></td>

                    <td scope="row" class="td-icon">
                      <div class="form-check icon icon-sm">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </td>
                    <td scope="row" class="td-icon"></td>
                    <td contenteditable="true" spellcheck="false">Bridie 1</td>
                    <td contenteditable="true" spellcheck="false">Bridie 2</td>
                    <td contenteditable="true" spellcheck="false">Bridie 3</td>
                    <td contenteditable="true" spellcheck="false">Bridie 4</td>
                    <td contenteditable="true" spellcheck="false">Bridie 5</td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      </div>
                    </td>

                    <td>
                      <div class="file-box-title">
                        <a target="blank" href="#">
                          <i class="bi bi-file-earmark-arrow-down-fill"></i>
                          <span>file name</span>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Bordered Table -->
                
                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
<script src="{{ asset('assets/js/checked_file_data/checkedFileData.js') }}"></script>
    <script>
        const arr = [
          name: "sajdj",
        ]
    </script>
@endsection
@endsection