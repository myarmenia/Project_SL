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
                <tbody id="table_id">
                </tbody>
            </div>
        </div>
    </div>
</div>
