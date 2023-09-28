@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/bibliography/style.css') }}">
@endsection


@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Նյութ</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
               
                
                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">Մուտքագրման ամսաթիվ</span>
                
                <span>19-09-2023</span>
                </div>

                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">Մուտքագրման Ժամ</span>
                
                <span>11։05։56</span>
                </div>
                <!-- To open modal """fullscreenModal""" -->
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item1"
                      placeholder=""
                      data-id="1"
                      value=""
                      name="inp1"
                      list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url="url/1"
                  ></i>
                    <label for="item1" class="form-label"
                      >1) Տեղեկատվություն տրամադրող մարմին</label
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
                      name="inp2"
                      list="brow2"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url="url/2"
                  ></i>
                    <label for="item2" class="form-label"
                      >2) Փաստաթղթի կատեգորիա</label
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
                      name="inp3"
                      list="brow3"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url="url/3"
                  ></i>
                    <label for="item3" class="form-label"
                      >3) Մուտքի մակարդակ</label
                    >
                  </div>
                  <datalist id="brow3" class="input_datalists" style="width: 500px;">
                 
                  </datalist>
                </div>
                
                <!-- Date Input -->
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp4"
                    />
                    <label for="inputDate2" class="form-label"
                      >4) Փաստաթուղթը մուտքագրող օ/ա</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp5"
                    />
                    <label for="inputDate2" class="form-label"
                      >5) Փաստաթուղթը գրանցման համար</label
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
                      id="inputDate1"
                      class="form-control"
                      placaholder=""
                      name="inp6"
                    />
                    <label for="inputDate1" class="form-label"
                      >6) Գրանցման ամսաթիվ</label
                    >
                    <!-- </div> -->
                  </div>
                </div>
                <!-- Inputs -->
                
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp7"
                    />
                    <label for="inputDate2" class="form-label"
                      >7) Փաստաթուղթն ստացող օ/ա</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp8"
                    />
                    <label for="inputDate2" class="form-label"
                      >8) Ստորաբաժանում, որտեղ պահվում են նախնական նյութեր</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp9"
                    />
                    <label for="inputDate2" class="form-label"
                      >9) Նաղնական նյութերի պահպանման տեղ</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp10"
                    />
                    <label for="inputDate2" class="form-label"
                      >10) Փաստաթղթի համառոտ բովանդակություն</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp11"
                    />
                    <label for="inputDate2" class="form-label"
                      >11) Տեղեկությունը վերաբերվում է ․․․թ</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputDate2"
                      placeholder=""
                      name="inp12"
                    />
                    <label for="inputDate2" class="form-label"
                      >12) Տեղեկության աղբյուր</label
                    >
                  </div>
                </div>
                
                <div class="col">
                   <div class="tegs-div">
                    <div class="Myteg">
                      <span>AAAAAA</span>
                      <span>X</span>
                    </div>
                    <div class="Myteg">
                      <span>AAAAAA</span>
                      <span>X</span>
                    </div>
                    <div class="Myteg">
                      <span>bbbbb</span>
                      <span>X</span>
                    </div>
                  </div> 
                  <div class="form-floating">
                    
                    <input
                      type="text"
                      class="form-control fetch_input_title"
                      id="item4"
                      placeholder=""
                      data-id="4"
                      name="inp13"
                      list="brow4"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-url="url/4"
                  ></i>
                    <label for="item4" class="form-label"
                      >13) Երկիր, որին վերաբերում է տեղեկությունը</label
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
                      id="inputDate2"
                      placeholder=""
                      name="inp14"
                    />
                    <label for="inputDate2" class="form-label"
                      >14) Թեմատիկայի անվանումը</label
                    >
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputPassportNumber1"
                      placeholder=""
                      name="inp15"
                      
                    />
                    <label for="inputPassportNumber1" class="form-label"
                      >15) Փաստաթղթի Վերնագիրը</label
                    >
                  </div>
                </div>
                
                <div class="col">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="inputPassportNumber1"
                      placeholder=""
                      name="inp16"
                    />
                    <label for="inputPassportNumber1" class="form-label"
                      >16) Փաստաթղթի բովանդակություն</label
                    >
                  </div>
                </div>
                <div
                class="col d-flex align-items-center gap-3 modal-toggle-box flex-wrap my-date-class"
                >
                <span class="form-label">17) Վիդեեյի առկայություն</span>
                
                <div class="form-check my-formCheck-class">
                  <input class="form-check-input" type="checkbox" id="checkAll" name="hasVideo"/>
                </div>
                </div>
                  <h6>ԱՆՁ (ՔԱՆԱԿԸ) ։ 0</h6>
                <div class="col">
                  <div class="form-floating">
                    <select class="form-select form-control" name="selectInfo">
                      <option selected disabled value="" hidden></option>
                      <option value="1">One</option>
                    </select>
                    <label class="form-label"
                      >18) Պարունակում է տեղեկատվություն</label
                    >
                  </div>
                </div>
                
               
                
              </div>

              <!-- ######################################################## -->
              <!-- Submit button -->
              <!-- ######################################################## -->
            </form>
            <!-- Vertical Form -->
          </div>
        </div>
      </section>
      <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- ########################################################################### -->
    <!-- ############################## Modals #################################### -->
    <!-- ########################################################################### -->

    <!-- fullscreenModal -->
    <div
      class="modal fade my-modal"
      id="fullscreenModal"
      tabindex="-1"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <form id="addNewInfoBtn">
              <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="addNewInfoInp"
                  placeholder=""
                />
                <label for="item21" class="form-label"
                  >Ֆիլտրացիա</label
                >
              </div>

              <button type="submit" class="btn btn-primary">Ավելացնել նոր գրանցում</button>
              

            </form>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="numbering" scope="col">#</th>
                  <th scope="col">Անվանում</th>
                  <th scope="col" class="td-xs"></th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td class="inputName">ggg</td>
                    <td>
                      <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ավելացնել</button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td class="inputName">fff</td>
                    <td>
                      <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ավելացնել</button>
                    </td>
                  </tr>
              </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    <div id="errModal" class="error-modal">
      <div class="error-modal-info">
          <p>soryyyyyy</p>
          <button type="button" class="addInputTxt btn btn-primary my-close-error">Լավ</button>
      </div>
    </div>

@section('js-scripts')
<script src='{{ asset('assets/js/bibliography/script.js') }}'></script>
@endsection
@endsection

