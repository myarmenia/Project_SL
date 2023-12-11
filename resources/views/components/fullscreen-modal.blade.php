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
                        <h6 class="modal_inp_label"></h6>
                        <label for="item21" class="form-label modal_form_label"
                        >{{ __('content.filtr') }}</label
                        >
                    </div>
                    <table id="filter_content">

                    </table>

                    <button type="submit" class="btn btn-primary">{{ __('content.createNew') }}</button>
                </form>
            </div>
            <div class="modal-body" style="padding: 0;">
                <table class="table table-bordered">
                    <thead>
                        <tr style = "background-color: #c6d5ec; position: sticky; top: 0">
                        <th class="numbering" scope="col">#</th>
                        <th scope="col">{{ __('content.name') }}</th>
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

