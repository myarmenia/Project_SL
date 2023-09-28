@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/test-test.css') }}">
@endsection


@section('content')
<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>Գործածողների ցուցակ</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">
                Տվյալների մուտքագրում ֆայլերի միջոցով
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- End Page Title -->

      <!-- List of users -->

      <section class="section">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div
                class="d-flex justify-content-between align-items-center my-3"
              ></div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-opModal" data-bs-toggle="modal" data-bs-target="#exampleModalLg">Ավելացնել նոր գրառում</button>

    
              <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/" data-edit-url="cc/edit" data-create-url="cc/create">
                <thead>
                  <tr>
                    <th class="filter-th" data-type="filter-id">Id</th>
                    
                    <th class="filter-th" data-type="standart">
                      Անվանում <i class="fa fa-filter" aria-hidden="true"></i>
                    </th>
                    <th></th>
                    
                  </tr>
                  
                </thead>
                <tbody>
                  
                  <tr>
                    
                    <td class="trId">1</td>
                    <td class="tdTxt">
                      <span>ffff</span>
                      <input
                      type="text"
                      class="form-control"
                      required
                      placeholder=""
                    />
                    </td>
                    <td>
                      <a class="my-edit"  href="#"><i class="bi bi-pencil-square"></i></a>
                      <button 
                      class="btn_close_modal my-delete-item"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteModal"
                      data-id="1"
                        ><i class="bi bi-trash3"></i>
                      </button>
                      <button class="btn btn-primary my-btn-class my-sub">Թարմացնել</button>
                      <button class="btn btn-secondary my-btn-class my-close">Չեղարկել</button>
                      </td>

                  </tr>
                  <tr>
                    
                    <td class="trId">2</td>
                    <td class="tdTxt">
                      <span>ggggg</span>
                      <input
                      type="text"
                      class="form-control"
                      required
                      placeholder=""
                    />
                    </td>
                    <td>
                      <a class="my-edit" href="#"><i class="bi bi-pencil-square"></i></a>
                      <button 
                      class="btn_close_modal my-delete-item"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteModal"
                      data-id="1"
                        ><i class="bi bi-trash3"></i>
                      </button>
                      <button class="btn btn-primary my-btn-class my-sub">Թարմացնել</button>
                      <button class="btn btn-secondary my-btn-class my-close">Չեղարկել</button>
                      </td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- modal block -->
      <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"  id="close_button" data-bs-dismiss="modal">Չեղարկել</button>
              <form action="" id="delete_form">
                <button type="button" class="btn btn-primary" id="delete_button">Հաստատել</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- modal range -->

      <!-- <div class="modal" id="avtiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"  id="cancel_btn" data-bs-dismiss="modal">Չեղարկել</button>
              <form action="" id="status_form">
                <button type="button" class="btn btn-primary" id="isActive_button" data-bs-dismiss="modal">Հաստատել</button>
              </form>
            </div>
          </div>
        </div>
      </div> -->

      <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalLgLabel">Ավելացնել նոր գրառում</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class='my-form-class' action="ghjk">
        <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      required
                      placeholder=""
                    />
                    <label class="form-label">Անվանում</label>
                  </div>

                  <button class='btn btn-primary my-class-sub'>Ավելացնել</button>
        </form>
      </div>
    </div>
  </div>
</div>

    @section('js-scripts')
        <script src='{{ asset('assets/js/test-test.js') }}'></script>
    @endsection

@endsection