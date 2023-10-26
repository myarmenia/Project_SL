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

                    </tbody>
                </table>
            </div>
            </div>
      </div>
    </div>
