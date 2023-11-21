@extends('layouts.auth-app')

@section('style')
<link href="{{ asset('assets/css/search-file/index.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/main/table.css') }}" rel="stylesheet" />
<style>
  #modal_save:disabled {
    background-color: #ddd;
    cursor: not-allowed; 
  }
</style>
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.search') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('sidebar.search-file') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                  <form id="carForm"  action="/{{ app()->getLocale() }}/simplesearch/result_car" method="post">
                    <div class="search-buttons-block">
                      <div class="buttons">
                        <input type="button" class="k-button search-button" data-value = '+' value="{{ __('content.and') }}" id="car_and" />
                        <input type="button" class="k-button search-button" data-value="" value="{{ __('content.or') }}" id="car_or" />
                        <input type="button" class="k-button search-button" data-value = '-' value="{{ __('content.not_equal') }}" id="not_equal" />
                        @if(!isset($type))
                            <a href="" id="resetButton"  class="k-button button-href" >{{ __('content.reset') }}</a>
                        @endif
                    </div>
                    </div>
                    <div id="search_text">
                      <input type="text" class="form-control" id="search_input" oninput="checkInput()" style="width: 35%"/>
                      <input type="hidden" class="form-input">
                      <button  class="btn btn-primary" id="serach_button" disabled>{{ __('content.search')}}</button>
                    </div>
                    <!-- End Bordered Table -->
                    <div class="all-check-input-block">

                      <div class="input-check-input-block">
                        <input type="checkbox" class="search-input">
                        <label for="">Թարգմանություն</label>
                      </div>

                      <div class="input-check-input-block">
                        <input type="checkbox" class="search-input">
                        <label for="">Հոմանիշներով</label>
                      </div>

                      <div class="input-check-input-block">
                        <input type="checkbox" class="search-input similarity-input" >
                        <label for="">Նմանությունով</label>
                      </div>

                      <div class="select-block">
                        <x-select-distance-search-file style=" display:none; visibility: hidden;" name="additional_data_distance" class="form-select distance distance_searchCarAdditionalData distance-search-file"/>
                      </div>

                    </div>
                </div>
            </div>
                    
            
                </form>

                    <!-- Bordered Table -->
                   

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
<script src="{{ asset('assets/js/search-file/search-file.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function checkInput() {
    let textValue = $('#search_input').val();
    let saveButton = $('#serach_button');

    if (textValue.trim() !== '') {
      saveButton.prop('disabled', false);
    } else {
      saveButton.prop('disabled', true);
    }
  }


</script>

<script>
  let create_response= "{{ __('content.create_response') }}"
  let association = "{{ __('content.association') }}"
  let keyword = "{{ __('content.keyword') }}"
  let fileName = "{{ __('content.fileName') }}"
  let contactPerson ="{{ __('content.contactPerson') }}"
</script>
@endsection
@endsection
