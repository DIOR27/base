<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file"
                        class="custom-file-input"
                        id="inputGroupFile"
                        name="{{ $inputName }}"
                        accept=" image/*">
                    <label class="custom-file-label"
                        for="inputGroupFile"
                        aria-describedby="inputGroupFileAddon">{{ $labelText ?? __('Choose image') }}</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text"
                        id="inputGroupFileAddon"><i class="far fa-image"></i></span>
                </div>
            </div>
            <div class="border rounded-lg text-center p-3">
                <img src="//placehold.it/140?text=IMAGE"
                    class="img-fluid"
                    id="preview" />
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('argon/js/imageSelector.js') }}"></script>
@endpush
