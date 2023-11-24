@extends('layouts.auth-app')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .my-inp-div {
        margin: 0 !important;
        margin-left: 180px !important;
    }

    .my-valid-form-control{
        display: block !important;
    }
    .myclass{
        align-items: flex-start !important;
    }
</style>

@section('content')

    <x-breadcrumbs :title="__('pagetitle.data-entry-through-files')" />
    <!-- End Page Title -->


    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form class="row g-3 needs-validation myclass uploadFormClass" novalidate
                        action="{{ route('table-content.store', ['locale' => app()->getLocale()]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h4>{{__('content.table_file')}}</h4>

                        <div class="my-radio-btns-class">
                            <input type="hidden" name="bibliography_id" value="{{$bibliographyId}}">
                            <input type="radio" id="contactChoice1" name="lang" value="armenian" checked />
                            <label for="contactChoice1">{{__('content.lang_am')}}</label>

                            <input type="radio" id="contactChoice2" name="lang" value="russian" />
                            <label for="contactChoice2">{{__('content.lang_ru')}}</label>

                            <input type="radio" id="contactChoice3" name="lang" value="english" />
                            <label for="contactChoice3">{{__('content.lang_eng')}}</label>

                            <input type="checkbox" id="contactChoice10" name="fonetic" value="armenian" />
                            <label for="contactChoice3">fonetic</label>


                        </div>
                        <div class="my-radio-btns-class">
                            <input type="radio" id="contactChoice1" name="title" value="has_title" checked />
                            <label for="contactChoice1">{{__('content.title_table')}}</label>

                            <input type="radio" id="contactChoice2" name="title" value="not_has_title" />
                            <label for="contactChoice2">{{__('content.notTitle_table')}}</label>
                        </div>


                            <div class="col-12">
                            <div class="form-floating  my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required  placeholder=""
                                        name="column_name[number]" />
                                    <span>{{__('content.numbering')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[first_name]" />
                                    <span>{{__('content.first_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[last_name]" />
                                    <span>{{__('content.last_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[middle_name]"/>
                                    <span>{{__('content.middle_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-floating  my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[birthday]" />
                                    <span>{{__('content.date_of_birth_')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                         <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"
                                        placeholder="" name="column_name[address]" />
                                    <span>{{__('content.address')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[first_name-middle_name-last_name]"  />
                                    <span>{{__('content.first_name').' '.__('content.middle_name').' '.__('content.last_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="surname_name_patronomic" class="form-control myFormValid"
                                         required  placeholder=""
                                        name="column_name[first_name-last_name-middle_name]"  />
                                    <span> {{__('content.first_name').' '.__('content.last_name').' '.__('content.middle_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="surname_name_patronomic" class="form-control myFormValid"
                                         required  placeholder=""
                                        name="column_name[last_name-first_name-middle_name]"  />
                                    <span>{{__('content.last_name').' '.__('content.first_name').' '.__('content.middle_name')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[family_mamber]" />
                                    <span>{{__('content.family_member')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[passport_credentials]"  />
                                    <span>{{__('content.passport_details')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[birthday-address]" />
                                    <span>{{__('content.birth_address_data')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[date]"/>
                                    <span>{{__('content.date')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[embassy]"/>
                                    <span>{{__('content.embassy')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating my-valid-form-control">
                                <div class="my-inp-div">
                                    <input type="number" class="form-control myFormValid"  required
                                        placeholder="" name="column_name[document_number]" />
                                    <span>{{__('content.document_number')}}</span>
                                </div>
                                <div class="invalid-feedback">
                                {{__('content.enter_col_num')}}
                                </div>
                            </div>
                        </div>

                         <input type=file>

                        <div class="file-upload-container my-upload-btn">
                            <input id="file_id" type="file" name="file" data-href-type="" class="file-upload"
                                data-render-type="none" multiple hidden accept=".doc,.docx,.pdf,.xlsx" />
                            <label for="file_id" class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                            {{__('content.upload')}}
                            </label>
                            <span class="file-name"></span>
                        </div>


                        <div class="col-12 my-btn-class">
                            <button class="btn btn-primary" type="submit">
                            {{__('content.forward')}}
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
