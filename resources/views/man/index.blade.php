@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/errorModal.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active"><b> ID: {{$manId}}</b></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="tegs-div">
                                <div class="Myteg">
                                    <span>fghgg</span>
                                    <span>X</span>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate"
                                    id="inputLastNanme4"
                                    placeholder=""
                                    name="last_name"
                                />
                                <label for="inputLastNanme4" class="form-label"
                                >1) Ազգանուն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="tegs-div">
                                <div class="Myteg">
                                    <span>llll</span>
                                    <span>X</span>
                                </div>
                            </div>
                            <div class="form-floating ">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate"
                                    id="inputNanme4"
                                    placeholder=""
                                    name="first_name_id"
                                />
                                <label for="inputNanme4" class="form-label">2) Անուն</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="tegs-div">
                                <div class="Myteg">
                                    <span>kkkk</span>
                                    <span>X</span>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate"
                                    id="inputMiddleName"
                                    placeholder=""
                                    name="middlename"
                                />
                                <label for="inputMiddleName" class="form-label"
                                >3) Հայրանուն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fullName"
                                    placeholder=""
                                    readonly=""
                                    tabindex="-1"
                                    name="inp4"
                                />
                                <label for="fullName" class="form-label"
                                >4) Ազգանուն Անուն Հայրանուն</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Հայտնի է որպես անուն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="users">дерфтгыху</div>
                        </div>
                        <!-- To open modal """fullscreenModal""" -->

                        <!-- Date Input -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store"/> -->
                                <input
                                    type="date"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control"
                                    name="birth_day"
                                />
                                <label for="inputDate1" class="form-label"
                                >6) Ծննդյան տարեթիվ (օր, ամիս, տարի)</label
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
                                    name="inp6"
                                />
                                <label for="inputDate2" class="form-label"
                                >7) Ծննդյան մոտավոր տարեթիվ</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control "
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="number"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >8) Անձնագրի համարը</label
                                >
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate" id="item1"
                                    placeholder=""
                                    data-id="1"
                                    value="{{$man->gender->name ?? null }}"
                                    name="gender_id"
                                    list="gender"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/1"
                                    data-table-name='gender'
                                    data-fieldname ='name'
                                ></i>
                                <label for="item1" class="form-label"
                                >9) Սեռ</label
                                >
                            </div>
                            <datalist id="gender" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>

                            {{--                            <div class="col">--}}
                            {{--                                <div class="form-floating">--}}
                            {{--                                    <div method="POST"--}}
                            {{--                                         action="{{route('man.update', ['man' => $manId, 'data' => ['intermediate'=> 1,'table'=>'passport','field' =>'number','value' => 15555]])}}">--}}
                            {{--                                        @method('PUT')--}}
                            {{--                                        @csrf--}}
                            {{--                                        <input--}}
                            {{--                                                type="text"--}}
                            {{--                                                class="form-control intermediate"--}}
                            {{--                                                id="item1"--}}
                            {{--                                                placeholder=""--}}
                            {{--                                                data-id="1"--}}
                            {{--                                                name="number"--}}
                            {{--                                        />--}}
                            {{--                                        <button type="submit">Submit</button>--}}
                            {{--                                    </div>--}}
                            {{--                                    <i--}}
                            {{--                                            class="bi bi-plus-square-fill icon icon-base my-plus-class"--}}
                            {{--                                            data-bs-toggle="modal"--}}
                            {{--                                            data-bs-target="#fullscreenModal"--}}
                            {{--                                            data-url="url/1"--}}
                            {{--                                    ></i>--}}
                            {{--                                    <label for="item1" class="form-label"--}}
                            {{--                                    >8) Անձնագրի համարը</label--}}
                            {{--                                    >--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item2"
                                    placeholder=""
                                    data-id="2"
                                    name="nation_id"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/2"
                                ></i>
                                <label for="item2" class="form-label"
                                >10) Ազգություն</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item3"
                                    placeholder=""
                                    data-id="3"
                                    name="inp10"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                ></i>
                                <label for="item3" class="form-label"
                                >11) Քաղաքացիություն</label
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
                                    data-id="4"
                                    name="inp11"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                ></i>
                                <label for="item4" class="form-label"
                                >12) Ծննդավայր (երկիր, ՎՏՄ)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item5"
                                    placeholder=""
                                    data-id="5"
                                    name="inp12"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/5"
                                ></i>
                                <label for="item5" class="form-label"
                                >13) Ծննդավայր (մարզ, տեղական)</label
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
                                    data-id="6"
                                    name="inp13"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/6"
                                ></i>
                                <label for="item6" class="form-label"
                                >14) Ծննդավայր (բնակավայր, տեղական)</label
                                >
                            </div>
                        </div>

                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control intermediate"
                                    id="inputDate2"
                                    placeholder=""
                                    name="born_address_id"
                                />
                                <label for="inputDate2" class="form-label"
                                >15) Ծննդավայր (շրջան)</label
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
                                >16) Ծննդավայր (բնակավայր)</label
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
                                    data-id="7"
                                    name="inp16"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/7"
                                ></i>
                                <label for="item7" class="form-label"
                                >17) Լեզուների Իմացություն</label
                                >
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">18) Անձի բնակության վայրը</label>
                            <a href="/btn2">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv2" id="address"></div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">19) Հեռախոսահամար</label>
                            <a href="{{route('phone.create',$manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv3" id="phoneNumber"></div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">20) Էլեկտրոնային հասցե (e-mail)</label>
                            <a href="{{route('email.create',$manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv4" id="email"></div>
                        </div>

                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder=""/>
                                <label class="form-label">21) Ուշադրություն</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Լրացուցիչ տեղեկություններ անձի վերաբերյալ</label>
                            <button class="btn btn-primary" style="font-size: 13px" data-bs-toggle="modal"
                                    data-bs-target="#additional_information">Ավելացնել
                            </button>
                            <div class="tegs-div"></div>
                        </div>

                        <!-- Select -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item8"
                                    placeholder=""
                                    data-id="8"
                                    name="inp17"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/8"
                                ></i>
                                <label for="item8" class="form-label"
                                >23) Կրոն</label
                                >
                            </div>
                        </div>
                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder=""/>
                                <label class="form-label">24) Զբաղմունք</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item9"
                                    placeholder=""
                                    data-id="9"
                                    name="inp18"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/9"
                                ></i>
                                <label for="item9" class="form-label"
                                >25) Անձի Օպերատիվ կատեգորիա</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item10"
                                    placeholder=""
                                    data-id="10"
                                    name="inp19"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/10"
                                ></i>
                                <label for="item10" class="form-label"
                                >26) Հետախուզում իրականացնող երկիրը</label
                                >
                            </div>
                        </div>
                        <!-- Date Inputs -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <label role="value"></label>
                                <input type="text" hidden role="store"/> -->
                                <input type="date" placeholder="" class="form-control" name="inp20"/>
                                <label class="form-label"
                                >27) Հետազոտումը հայտարարվել է</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <label role="value"></label>
                                <input type="text" hidden role="store"/> -->
                                <input type="date" placeholder="" class="form-control" name="inp21"/>
                                <label class="form-label"
                                >28) ՀՀ տարածք մուտք գործելու վերահսկման սկիզբ
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <label role="value"></label>
                                <input type="text" hidden role="store"/> -->
                                <input type="date" placeholder="" class="form-control" name="inp22"/>
                                <label class="form-label">29) ՀՀ տարածք մուտք գործելու վերահսկման ավարտ</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item11"
                                    placeholder=""
                                    data-id="11"
                                    name="inp23"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/11"
                                ></i>
                                <label for="item11" class="form-label"
                                >30) Կրթություն։ Գիտական աստիճան, կոչում</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item12"
                                    placeholder=""
                                    data-id="12"
                                    name="inp24"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/12"
                                ></i>
                                <label for="item12" class="form-label"
                                >31) Կուսակցական պատկանելություն</label
                                >
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">32) Անձի աշխատանքային գործունեություն</label>
                            <a href="{{route('organization.create', $manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">33) Արտասահմանում Գտնվելը</label>
                            <a href="{{route('organization.create',$manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv6"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">34) Արտաքին նշաններ</label>
                            <a href="{{route('sign.create', $manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv7"></div>
                        </div>

                        <!-- To open modal """fullscreenModal""" with File input-->
                        <div class="btn-div">
                            <label class="form-label">35) Արտաքին նշաններ (լուսանկար)</label>
                            <a href="{{route('sign-image.create', $manId)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv8"></div>
                        </div>
                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder=""/>
                                <label class="form-label">36) Ծածկանուն</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">37) Օպերատիվ հետաքրքրություն ներկայացնող կապեր (անձ)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv9"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">38) Օպերատիվ հետաքրքրություն ներկայացնող կապեր
                                (Կազմակերպություն)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv10"></div>
                        </div>

                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="" name="inp25"/>
                                <label class="form-label">39) Անձի նկատմամբ բացվել է ՕՀԳ</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">40) Գործողության մասնակից</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv11"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">41) Առնչվում է իրադարձությանը</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDive12"></div>
                        </div>

                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="item13"
                                    placeholder=""
                                    data-id="13"
                                    name="inp26"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/13"
                                ></i>
                                <label for="item13" class="form-label"
                                >42) Տեղեկատվության աղբյուր</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">43) Հանդիսանում է ահազանգի ստուգման օբյեկտ</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv13"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">44) Անցնում է ահազանգով</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv14"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">45) Հարուցվել է քրեական գործ</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv15"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">46) Անցնում է ոստիկանության ամփոփագրով</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv16"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">47) Ավտոմեքենայի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv17"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">48) Զենքի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv18"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">49) Օգտագործվող ավտոմեքենա</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv19"></div>
                        </div>


                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">50) Պատասխան</span>
                            <div class="file-upload-container">
                                <input
                                    type="file"
                                    class="file-upload"
                                    hidden
                                    multiple
                                    placaholder=""
                                />
                                <label
                                    class="file-upload-btn btn btn-secondary h-fit w-fit"
                                >
                                    Բեռնել
                                </label>
                                <div class="file-upload-content"></div>
                            </div>
                        </div>
                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">51) Փաստաթղթի բովանդակութըունը</span>
                            <div class="file-upload-container">
                                <input
                                    type="file"
                                    class="file-upload"
                                    hidden=""
                                    multiple=""
                                    id="eRaXbff"
                                    placaholder="a"
                                />
                                <label
                                    class="file-upload-btn btn btn-secondary h-fit w-fit"
                                    for="eRaXbff"
                                >
                                    Բեռնել
                                </label>
                                <div class="file-upload-content"></div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">52) Կապեր</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv20">
                                <div class="Myteg">
                                    <span>kkkk</span>
                                    <span>X</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>
    <x-scroll-up/>
    <x-large-modal :dataId="$manId"/>
    <x-fullscreen-modal/>

    @section('js-scripts')
        <script>
            let lang="{{app()->getLocale()}}"
            let open_modal_url="{{route('open.modal')}}"
            let get_filter_in_modal = "{{route('get-model-filter')}}"
            let updated_route ="{{route('man.update',$manId)}}"
            let file_updated_route ="{{ route('updateFile',$manId)}}"
            let delete_item="{{route('delete-item')}}"
        </script>
        {{--            <script src='{{ asset('assets/js/man/script.js') }}'></script>--}}
        <script src='{{ asset('assets/js/script.js') }}'></script>

    @endsection
@endsection
