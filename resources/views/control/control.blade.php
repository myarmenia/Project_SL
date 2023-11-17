@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/control/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Վերահսկում</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Նյութ</li>
              <li class="breadcrumb-item active">ID: 1</li>
            </ol>
          </nav>
        </div>
</div>
      <!-- End Page Title -->

      <section class="section">
        <div class="card">
          <div class="card-body">


            <!-- Vertical Form -->
            <form class="form">
              <div class="inputs row g-3">

              <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item1"
                      placeholder=""
                      data-id="1"
                      name="access_level_id"
                      list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item1" class="form-label"
                      >1) Ստորաբաժանում</label
                    >
                  </div>
                  <datalist id="brow1" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item2"
                      placeholder=""
                      data-id="2"
                      name="access_level_id"
                      list="brow2"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item2" class="form-label"
                      >2) Փաստաթղթի կատեգորիա</label
                    >
                  </div>
                  <datalist id="brow2" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="date"
                      placeholder=""
                      id="item3"
                      class="form-control"
                      placaholder=""
                      name="inp3"
                    />
                    <label for="item3" class="form-label"
                      >3) Փաստաթղթի կազմման ամսաթիվ</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item4"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item4" class="form-label"
                      >4) Փաստաթղթի գրանցման ամսաթիվը</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="date"
                      placeholder=""
                      id="item5"
                      class="form-control"
                      placaholder=""
                      name="inp5"
                    />
                    <label for="item5" class="form-label"
                      >5) Գրանցման ամսաթիվ</label
                    >
                  </div>
                </div>
                
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item6"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item6" class="form-label"
                      >6) ԱԱԾ տնօրեն (ԱՀԱ)</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item7"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item7" class="form-label"
                      >7) ԱԱԾ Փոխտնօրեն (ԱՀԱ)</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="date"
                      placeholder=""
                      id="item8"
                      class="form-control"
                      placaholder=""
                      name="inp8"
                    />
                    <label for="item8" class="form-label"
                      >8) Մակագրության ամսաթիվ</label
                    >
                  </div>
                </div>

                <div class="col">
                    <div class="form-floating">
                      <textarea name="" id="area" cols="30" rows="10" class="form-control"></textarea>
                      <label for="area" class="form-label"
                        >9) Մակագրություն</label
                      >
                    </div>
                  </div>

                  <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item10"
                      placeholder=""
                      data-id="10"
                      name="access_level_id"
                      list="brow3"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item10" class="form-label"
                      >10) Կատարող Ստորաբաժանում</label
                    >
                  </div>
                  <datalist id="brow3" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item11"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item7" class="form-label"
                      >11) Կատարողի ազգանունը</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item12"
                      placeholder=""
                      data-id="12"
                      name="access_level_id"
                      list="brow4"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item12" class="form-label"
                      >12) Համատեղ կատարող ստորաբաժանում</label
                    >
                  </div>
                  <datalist id="brow4" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item13"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item13" class="form-label"
                      >13) Կատարողի ազգանունը</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item14"
                      placeholder=""
                      data-id="14"
                      name="access_level_id"
                      list="brow5"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url = '{{route('get-model-filter',['path'=>'access_level'])}}'
                    data-section = 'get-model-name-in-modal'
                    data-id = 'access_level'
                  ></i>
                    <label for="item14" class="form-label"
                      >14) Կատարման արդյունքը</label
                    >
                  </div>
                  <datalist id="brow5" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="btn-div">
                    <label class="form-label">15) Փաստաթղթի բովանդակութըունը</label>
                    <div class="file-upload-content tegs-div">
                          <div class="Myteg">
                            <span><a href="">dddd</a></span>
                          </div>
                          <div class="Myteg">
                            <span><a href="">ffff</a></span>
                          </div>
                        </div>
                </div>

                <div class="btn-div">
                    <label class="form-label">16) Կապեր</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police"></div>
                </div>

              </div>
            </form>

            <!-- Vertical Form -->
          </div>
        </div>
        </section>

    <input type="hidden"  id="file_updated_route" value="">
    <input type="hidden"  id="deleted_route" value=""  data-pivot-table = "file">

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script>
            let lang="{{app()->getLocale()}}"
            let open_modal_url=`{{route('open.modal')}}`
            let get_filter_in_modal = `{{route('get-model-filter')}}`
            // console.log(delete_item);

        </script>

            <script src="{{ asset('assets/js/script.js') }}"></script>
            <script src="{{ asset('assets/js/tag.js') }}"></script>
            <script src="{{ asset('assets/js/file_deleted.js') }}"></script>
            <script src="{{ asset('assets/js/error_modal.js') }}"></script>



    @endsection
@endsection

