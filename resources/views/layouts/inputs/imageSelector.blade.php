<style>
    .custom-file-input~.custom-file-label::after {
        content: "{{ __('Browse') }}";
    }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file"
                    class="custom-file-input"
                    id="inputGroupFile"
                    name="{{ $inputName }}"
                    accept=" image/*">
                <label class="custom-file-label text-truncate"
                    for="inputGroupFile"
                    aria-describedby="inputGroupFileAddon">{{ $labelText ?? __('Choose image') }}</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text"
                    id="inputGroupFileAddon"><i class="far fa-image"></i></span>
            </div>
        </div>
        <div class="border rounded-lg text-center p-3">
            <img src="{{ $thumbnailImage ?? asset('argon/img/theme/image.webp') }}"
                class="img-fluid"
                style="max-height: 140px;"
                id="preview" />
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('argon/vendor/bsCustomFileInput/bsCustomFileInput.min.js') }}"></script>
    <script src="{{ asset('argon/js/imageSelector.js') }}"></script>
@endpush
