@extends('layouts.auth-app')

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
        <h1>Անձեր</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        </div>
    </div>
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
                {{__('table.add')}}
                </button>
              </div>
              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('table.status')}}</th>
                    <th scope="col">{{__('table.remove')}}</th>
                    <th scope="col">{{__('table.name')}}</th>
                    <th scope="col">{{__('table.last_name')}}</th>
                    <th scope="col">{{__('table.patronymic')}}</th>
                    <th scope="col">{{__('table.birthday')}}</th>
                    {{-- <th scope="col">address</th>
                    <th scope="col">desc</th> --}}
                    <th scope="col" class="td-xs">{{__('table.file')}}</th>
                  </tr>
                </thead>
                <tbody>
                     {{-- {{$last_name[$key]['last_name']}} --}}
                    {{-- {{dd($last_name)}} --}}
                    @foreach ($first_name as $key=>$item )
                    <tr class="start">
                        <td scope="row">{{$item->id}}</td>

                        <td scope="row" class="td-icon">
                          <i class="bi icon icon-y icon-base bi-check"></i>
                        </td>
                        <td scope="row" class="td-icon">
                          <i class="bi icon icon-sm bi-trash"></i>
                        </td>

                        <td contenteditable="true" spellcheck="false">
                         {{$item->first_name}}
                        </td>
                        <td contenteditable="true" spellcheck="false">
                            {{-- {{$item->last_name}} --}}
                            {{$last_name[$key]['last_name']}}
                        </td>
                        <td contenteditable="true" spellcheck="false">

                            {{$middle_name[$key]!=null  && $middle_name[$key]['middle_name']!=null ? $middle_name[$key]['middle_name'] :null }}
                        </td>
                        <td contenteditable="true" spellcheck="false">
                          {{-- {{$man[$key]!=null ? $man[$key]['birthday_str'] : null }} --}}
                        </td>
                        {{-- <td contenteditable="true" spellcheck="false">
                          Bridie Kessler
                        </td>
                        <td class="td-lg td-scroll-wrapper">
                          <div class="td-scroll">
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit.
                          </div>
                        </td> --}}

                        <td>
                          <div class="file-box-title">
                            <a target="blank" href="#">
                              <i class="bi bi-file-earmark-arrow-down-fill"></i>
                              <span>file name</span>
                            </a>
                          </div>
                        </td>
                      </tr>

                    @endforeach
                  {{-- <tr class="start">
                    <td scope="row">2</td>

                    <td scope="row" class="td-icon">
                      <i class="bi icon icon-y icon-base bi-check"></i>
                    </td>
                    <td scope="row" class="td-icon">
                      <i class="bi icon icon-sm bi-trash"></i>
                    </td>

                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit.
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
                  </tr> --}}
                  {{-- <tr>
                    <td scope="row"></td>

                    <td scope="row" class="td-icon">
                      <div class="form-check icon icon-sm">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </td>
                    <td scope="row" class="td-icon"></td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit.
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
                  </tr> --}}
                  {{-- <tr class="end">
                    <td scope="row"></td>

                    <td scope="row" class="td-icon">
                      <div class="form-check icon icon-sm">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </td>
                    <td scope="row" class="td-icon"></td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td contenteditable="true" spellcheck="false">
                      Bridie Kessler
                    </td>
                    <td class="td-lg td-scroll-wrapper">
                      <div class="td-scroll">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit.
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
                  </tr> --}}
                </tbody>
              </table>
              <!-- End Bordered Table -->
            </div>
          </div>
        </div>
      </section>
       <!-- Start Modal  -->
    <div
    class="modal fade"
    id="fullscreenModal"
    tabindex="-1"
    style="display: none"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">new Person</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="inputs row gap-3">
            <div class="col">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="" />
                <label class="form-label">Lorem, ipsum.</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="" />
                <label class="form-label">Lorem, ipsum.</label>
              </div>
            </div>

            <div class="col">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="" />
                <label class="form-label">Lorem, ipsum.</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="" />
                <label class="form-label">Lorem, ipsum.</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating">
                <input type="text" class="form-control" placeholder="" />
                <label class="form-label">Lorem, ipsum.</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating mb-3">
                <textarea
                  class="form-control"
                  placeholder=""
                  style="height: 200px"
                ></textarea>
                <label>Lorem, ipsum.</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end Modal  -->

@endsection
