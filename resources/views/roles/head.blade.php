<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h5 class="card-title">Առկա Դերերի Ցանկեր</h5>

            <button id="add-new-btn" type="button" class="btn btn-secondary h-fit">
                Ավելացնել
            </button>
        </div>

        <div class="d-flex flex-row flex-wrap gap-3" id="groups">
            @foreach ($roles as $key => $role)

            <div class="group position-relative">
                <a href="{{ route('roles.edit', ['role' => $role->id, 'locale' => app()->getLocale()]) }}" data-btn="1" class="btn active btn-light mb-2 text-justify">
                    {{$role->name}}
                </a>
            </div>

            @endforeach
        </div>
    </div>
</div>