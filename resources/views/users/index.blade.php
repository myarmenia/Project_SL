@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
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
              <table
                id="resizeMe"
                class="person_table table"
                data-delete-url="aaa/delete/"
                data-status-url="bbb/status/"
                data-table-name="users-table"
                data-section-name="dictionary"
              >
                <thead>
                  <tr>
                    <th
                      class="filter-th"
                      data-sort="null"
                      data-type="filter-id"
                    >
                      Id
                      <i class="fa fa-filter" data-field-name="id" aria-hidden="true"></i>
                    </th>
                    <th class="filter-th" data-sort="null" data-type="standart">
                      Գործածողների անուն
                      <i class="fa fa-filter" data-field-name="username" aria-hidden="true"></i>
                    </th>
                    <th class="filter-th" data-sort="null" data-type="standart">
                      Անուն <i class="fa fa-filter" data-field-name="first_name" aria-hidden="true"></i>
                    </th>
                    <th class="filter-th" data-sort="null" data-type="standart">
                      Ազգանուն<i class="fa fa-filter" data-field-name="last_name" aria-hidden="true"></i>
                    </th>
                    <th class="filter-th" data-sort="null" data-type="standart">
                      Տարատեսակ<i class="fa fa-filter" data-field-name="roles" aria-hidden="true"></i>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="current-id" data-id="1">
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td>
                      <button
                        class="btn_close_modal"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-id="1"
                      >
                        <i class="bi bi-trash3"></i>
                      </button>
                    </td>
                    <td>
                      <input
                        type="range"
                        value="0"
                        min="0"
                        max="1"
                        class="rangeInput"
                        data-bs-toggle="modal"
                        data-bs-target="#avtiveModal"
                      />
                    </td>
                  </tr>
                  <tr class="current-id" data-id="2">
                    <td>2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td>
                      <button
                        class="btn_close_modal"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-id="2"
                      >
                        <i class="bi bi-trash3"></i>
                      </button>
                    </td>
                    <td>
                      <input
                        type="range"
                        value="0"
                        min="0"
                        max="1"
                        class="rangeInput"
                        data-bs-toggle="modal"
                        data-bs-target="#avtiveModal"
                      />
                    </td>
                  </tr>
                  <tr class="current-id" data-id="3">
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td>
                      <button
                        class="btn_close_modal"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-id="3"
                      >
                        <i class="bi bi-trash3"></i>
                      </button>
                    </td>
                    <td>
                      <input
                        type="range"
                        value="0"
                        min="0"
                        max="1"
                        class="rangeInput"
                        data-bs-toggle="modal"
                        data-bs-target="#avtiveModal"
                      />
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
              <button
                type="button"
                class="close close_modal"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                id="close_button"
                data-bs-dismiss="modal"
              >
                Չեղարկել
              </button>
              <form action="" id="delete_form">
                <button
                  class="btn btn-primary"
                  id="delete_button"
                  data-bs-dismiss="modal"
                >
                  Հաստատել
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- modal range -->

      <div class="modal" id="avtiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button
                type="button"
                class="close close_modal"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                id="cancel_btn"
                data-bs-dismiss="modal"
              >
                Չեղարկել
              </button>
              <form action="" id="status_form">
                <button
                  type="button"
                  class="btn btn-primary"
                  id="isActive_button"
                  data-bs-dismiss="modal"
                >
                  Հաստատել
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

@section('js-scripts')
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection

@endsection
