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
<<<<<<< HEAD
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
=======
                    <!-- Bordered Table -->

                    <form action="{{ route('search_file_result') }}" method="post">
                        <div id="search_text">

                            <select name="content_distance" class="distance distance_fileSearch" style="display: block"  aria-label="Default select example">
                                <option value="" >{{ __('content.choose_the_size') }}</option>
                                <option value="1" @if(isset($distance) && $distance == 1) selected @endif >100% {{ __('content.match') }}</option>
                                <option value="2" @if(isset($distance) && $distance == 2) selected @endif >90%-100% {{ __('content.match') }}</option>
                                <option value="3" @if(isset($distance) && $distance == 3) selected @endif >70%-100% {{ __('content.match') }}</option>
                                <option value="4" @if(isset($distance) && $distance == 4) selected @endif >50%-100% {{ __('content.match') }}</option>
                            </select>

                            <input name="search_input" type="text" class="form-control" id="search_input" value="{{ $search_input ?? '' }}" oninput="checkInput()" style="width: 35%"/>
                            <button class="btn btn-primary" id="serach_button" disabled>{{ __('content.search') }}</button>
                        </div>

                    </form>
>>>>>>> 3abba85d42919e0d87ba54ad4406c1d0c19d8a5d
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

            @if (session()->has('not_find_message'))
                <div class="alert alert-danger" role="alert" style="margin-top: 0.5rem;">
                    {{ session()->get('not_find_message') }}
                </div>
            @endif
        </div>
    </section>
    <section>
        @isset($datas)
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Տեղեկատվությունը տրամադրող մարմին</th>
                <th scope="col">Փաստաթղթի կատեգորիա</th>
                <th scope="col">Փաստաթուղթը մուտքագրող օ/ա</th>
                <th scope="col">Փաստաթղթի գրանցման համարը</th>
                <th scope="col">Գրանցման ամսաթիվ</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>
                        <p>Ֆայլի Անուն /</p>
                        <a href="{{ Storage::url($data['file_path']) }}" style="color: blue">{{ $data['file_info'] }}</a>
                    </td>
                    <td>
                        <p>Փնտրվող բառեր /</p>
                        <p style="color: red">{{ $search_input }}</p>
                    </td>
                    <td colspan="3">
                        <p>Տեքստ / </p>
                        <p>{{ $data['file_text'] }}</p>
                    </td>
                </tr>
                @endforeach

                @foreach ($datas as $data)
                    @if ($data['bibliography']->isNotEmpty())
                        @foreach($data['bibliography'] as  $bibliography)
                        <tr>
                            <th scope="row">{{ $bibliography->id }}</th>
                            <td>{{ $bibliography->agency->name ?? '' }}</td>
                            <td>{{ $bibliography->doc_category->name ?? '' }}</td>
                            <td>{{ $bibliography->users->username ?? '' }} </td>
                            <td>{{ $bibliography->reg_number ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($bibliography->reg_date)->format('d-m-y')  }}</td>
                        </tr>
                        @endforeach

                    @endif
                    @break
                @endforeach


            </tbody>
          </table>
          @endisset
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
