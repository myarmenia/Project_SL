@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/alarm-handling/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')

@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Ահազանգի վարում</h1>
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
                      >1) Ահազանգի ստուգող վարչություն</label
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
                      >2) Ահազանգի ստուգող բաժին</label
                    >
                  </div>
                  <datalist id="brow2" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item3"
                      placeholder=""
                      data-id="3"
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
                    <label for="item3" class="form-label"
                      >3) Ահազանգի ստուգող ստորաբաժանում</label
                    >
                  </div>
                  <datalist id="brow3" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="tegs-div"></div>
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="item4"
                      placeholder=""
                      name="short_desc"
                    />
                    <label for="item4" class="form-label"
                      >4) Օ/ա Ա․Հ․Ազգանունը</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item5"
                      placeholder=""
                      data-id="5"
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
                    <label for="item5" class="form-label"
                      >5) Օ/ա պաշտոնը</label
                    >
                  </div>
                  <datalist id="brow4" class="input_datalists" style="width: 500px;">

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
                      id="item6"
                      class="form-control"
                      placaholder=""
                      name="inp6"
                      data-check="date"
                    />
                    <label for="item6" class="form-label"
                      >6) Ահազանգի ստուգման սկիզբ</label
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
                      id="item7"
                      class="form-control"
                      placaholder=""
                      name="inp7"
                      data-check="date"
                    />
                    <label for="item7" class="form-label"
                      >7) Ահազանգի ստուգման ավարտ</label
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
                      data-check="date"
                    />
                    <label for="item8" class="form-label"
                      >8) Այլ ստորաբաժանում փոխանցման ամսաթիվ</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item9"
                      placeholder=""
                      data-id="9"
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
                    <label for="item9" class="form-label"
                      >9) Ստորաբաժանում, ուր փոխանցվել է ահազանգը</label
                    >
                  </div>
                  <datalist id="brow5" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="btn-div">
                    <label class="form-label">10) Կապեր</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                    <div class="tegs-div-content">
                        <div class="Myteg">
                          <span>fghj</span>
                          <span>X</span>
                        </div>
                        <div class="Myteg">
                          <span>fghj</span>
                          <span>X</span>
                        </div>
                        <div class="Myteg">
                          <span>fghj</span>
                          <span>X</span>
                        </div>
                        <div class="Myteg">
                          <span>fghj</span>
                          <span>X</span>
                        </div>
                      </div>
                    </div>
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

