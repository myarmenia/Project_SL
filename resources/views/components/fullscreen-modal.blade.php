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
                            name="name"
                            placeholder=""
                        />
                        <label for="item21" class="form-label"
                        >Ֆիլտրացիա</label
                        >
                    </div>
                    <table id="filter_content">

                    </table>

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
                    <tbody id="table_id">
                            {{-- @foreach ($agency as $item )
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td class="inputName">{{$item->name}}</td>
                                    <td>
                                    <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ավելացնել</button>
                                    </td>
                                </tr>

                            @endforeach --}}
                    </tbody>
                </table>
            </div>
            </div>
      </div>
    </div>
