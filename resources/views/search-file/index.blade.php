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
                    <!-- Bordered Table -->
                    <div id="search_text">
                      <input type="text" class="form-control" id="search_input" oninput="checkInput()" style="width: 35%"/>
                      <button class="btn btn-primary" id="serach_button" disabled>{{ __('content.search') }}</button>
                    </div>
                    <!-- End Bordered Table -->
                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
<script src="{{ asset('assets/js/search-file/search-file.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function checkInput() {
    var textValue = $('#search_input').val();
    var saveButton = $('#serach_button');

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
