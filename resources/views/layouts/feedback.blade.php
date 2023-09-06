<link rel="stylesheet" href="{{ asset('argon/css/feedback.css') }}">

<div id="feedback-form-wrapper">
    <div id="floating-icon">
        <button type="button"
            class="btn btn-primary btn-sm rounded-0"
            data-toggle="modal"
            data-target="#feedbackModal">
            Feedback
        </button>

    </div>
    <div id="feedback-form-modal">
        <div class="modal fade"
            id="feedbackModal"
            tabindex="-1"
            aria-labelledby="feedbackModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="feedbackModalLabel">{{ __('Feedback') }}</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ __('How likely you would like to recommand us to your friends?') }}</label>
                                <div class="rating-input-wrapper d-flex justify-content-between mt-2">
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">1</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">2</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">3</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">4</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">5</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">6</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">7</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">8</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">9</span></label>
                                    <label><input type="radio"
                                            name="rating" /><span class="border rounded px-3 py-2">10</span></label>
                                </div>
                                <div class="rating-labels d-flex justify-content-between mt-1">
                                    <label>{{ __('Very unlikely') }}</label>
                                    <label>{{ __('Very likely') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-two">{{ __('Would you like to leave a message?') }}</label>
                                <textarea class="form-control"
                                    id="input-two"
                                    rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button"
                            class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
