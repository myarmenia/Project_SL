@extends('layouts.auth-app')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }


    .my-inp-div{
      margin: 0 !important;
      margin-left: 180px !important;
    }
</style>

@section('content')
    {{-- <div class ="row">
        <form action="{{ route('table-content.store', ['locale' => app()->getLocale()]) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".doc, .docx,">
            <button type="submit">Upload File</button>
            <div class ="row my-3">
                <label><input type = "text" value = "" name = "column_name[number]" /><input type="checkbox" class="m-2" />number</label>
                <label><input type = "text" value = "" name = "column_name[first_name]"/><input type="checkbox" class="m-2"/>first name </label>
                <label><input type = "text" value = "" name = "column_name[last_name]"/><input type="checkbox" class="m-2"/>last name </label>
                <label><input type = "text" value = "" name = "column_name[middle_name]"/><input type="checkbox" class="m-2"/>middle name </label>
                <label><input type = "text" value = "" name = "column_name[birthday]"/><input type="checkbox" class="m-2"/>birthday</label>
                <label><input type = "text" value = "" name = "column_name[address]"/><input type="checkbox" class="m-2"/>address</label>
            </div>
        </form>

    </div> --}}
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Անձ</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Տվյալների մուտքագրում ֆայլերի միջոցով</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->

    <section class="section">
    <div class="col">
        <div class="card">
        <div class="card-body">
            <div
            class="d-flex justify-content-between align-items-center my-3"
            ></div>

            <form 
                class="row g-3 needs-validation myclass" novalidate
                action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST"
                enctype="multipart/form-data">
            <h4>Տեքստային Ֆայլ</h4>
            <div class="file-upload-container my-upload-btn">
                <input
                id="file_id_word"
                type="file"
                name="file"
                data-href-type=""
                class="file-upload"
                data-render-type="none"
                hidden
                accept=".doc,.docx"
                />
                <label for="file_id_word" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                  Բեռնել
                </label>
                <div class="file-upload-content"></div>
            </div>

            <div class="col-12 my-btn-class">
                <button class="btn btn-primary" type="submit">
                Առաջ
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </section>
    <section class="section">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div
                class="d-flex justify-content-between align-items-center my-3"
              ></div>

              <form class="row g-3 needs-validation myclass uploadFormClass" novalidate
                    action="{{ route('table-content.store', ['locale' => app()->getLocale()]) }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                <h4>Աղյուսակային Ֆայլ</h4>

                <div class="my-radio-btns-class">
                  <input type="radio" id="contactChoice1" name="lang" value="armenian" />
                  <label for="contactChoice1">Հայերեն</label>

                  <input type="radio" id="contactChoice2" name="lang" value="russian" />
                  <label for="contactChoice2">Ռուսերեն</label>

                  <input type="radio" id="contactChoice3" name="lang" value="english" />
                  <label for="contactChoice3">Անգլերեն</label>
                </div>
                <div class="my-radio-btns-class">
                    <input type="radio" id="contactChoice1" name="title" value="has_title" />
                    <label for="contactChoice1">Աղյուսակը ունի վերնագիր</label>

                    <input type="radio" id="contactChoice2" name="title" value="not_has_title" />
                    <label for="contactChoice2">Աղյուսակը չունի վերնագիր</label>
                </div>

                <div class="col-12">
                  <div class="form-floating myFormValid">
                    <div class="my-inp-div">
                          <input
                          type="number"
                          class="form-control"
                          {{-- required --}}
                          placeholder=""
                          name = "column_name[number]"
                          />
                          <span>Համարակալում</span>
                    </div>
                    <div class="invalid-feedback">
                      Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                  <div class="my-inp-div">
                    <input
                    type="number"
                    class="form-control myFormValid"
                    {{-- required --}}
                    placeholder=""
                    name = "column_name[first_name]"
                    min="1"
                    max="9"
                  />
                  <span>Անուն</span>
                  </div>
                    <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                    <div class="my-inp-div">
                      <input
                      type="number"
                      class="form-control myFormValid"
                      {{-- required --}}
                      placeholder=""
                      name = "column_name[last_name]"
                      min="1"
                      max="9"
                    />
                    <span>Ազգանուն</span>
                    </div>
                    <div class="invalid-feedback">
                      Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                   <div class="my-inp-div">
                    <input
                    type="number"
                    class="form-control myFormValid"
                    {{-- required --}}
                    placeholder=""
                    name = "column_name[middle_name]"
                    min="1"
                    max="9"
                  />
                  <span>Հայրանուն</span>
                   </div>
                    <div class="invalid-feedback">
                      Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>


                <div class="col-12">
                  <div class="form-floating ">
                    <div class="my-inp-div">
                      <input
                      type="number"
                      class="form-control myFormValid"
                      {{-- required --}}
                      placeholder=""
                      name = "column_name[birthday]"
                      min="1"
                      max="9"
                    />
                    <span>Ծննդյան Տարեթիվ</span>
                    </div>
                    <div class="invalid-feedback">
                      Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                    <div class="my-inp-div">
                      <input
                      type="number"
                      class="form-control myFormValid"
                      {{-- required --}}
                      placeholder=""
                      name = "column_name[address]"
                      min="1"
                      max="9"
                    />
                    <span>Հասցե</span>
                    </div>
                    <div class="invalid-feedback">
                      Խնդրում ենք մուտքագրեք սյունակի համարը։
                    </div>
                  </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="number"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[first_name-middle_name-last_name]"
                        min="1"
                        max="9"
                      />
                      <span>Անուն  Հայրանուն Ազգանուն</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="surname_name_patronomic"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[first_name-last_name-middle_name]"
                        min="1"
                        max="9"
                      />
                      <span> Անուն Ազգանուն Հայրանուն</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="surname_name_patronomic"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[last_name-first_name-middle_name]"
                        min="1"
                        max="9"
                      />
                      <span>Ազգանուն Անուն Հայրանուն</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="surname_name_patronomic"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[address]"
                        min="1"
                        max="9"
                      />
                      <span>Ազգանուն,   Անուն, Հայրանուն</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="number"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[family_mamber]"
                        min="1"
                        max="9"
                      />
                      <span>Ընտանիքի անդամ</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="number"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[passport_credentials]"
                        min="1"
                        max="9"
                      />
                      <span>Անձնագրային տվյալներ</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                      <div class="my-inp-div">
                        <input
                        type="number"
                        class="form-control myFormValid"
                        {{-- required --}}
                        placeholder=""
                        name = "column_name[birthday-address]"
                        min="1"
                        max="9"
                      />
                      <span>Ծննդյան տվյալներ,հասցեի տվյալներ</span>
                      </div>
                      <div class="invalid-feedback">
                        Խնդրում ենք մուտքագրեք սյունակի համարը։
                      </div>
                    </div>
                </div>
                {{-- <input type=file> --}}

                <div class="file-upload-container my-upload-btn">
                  <input
                    id="file_id"
                    type="file"
                    name="file"
                    data-href-type=""
                    class="file-upload"
                    data-render-type="none"
                    multiple
                    hidden
                    accept=".doc,.docx"
                  />
                  <label for="file_id" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                    Բեռնել
                  </label>
                  <div class="file-upload-content"></div>
                </div>


                <div class="col-12 my-btn-class">
                  <button class="btn btn-primary" type="submit" >
                    Առաջ
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
    @section('js-scripts')
        <script src="{{ asset('assets/js/file-upload-page/fileUpload.js') }}"></script>
    @endsection

@endsection
