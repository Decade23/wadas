<div class="tab-pane scroll scroll-pull" id="questionPanel" role="tabpanel">
    <div class="row">

        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet" >
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            <small>No.</small> <code>1</code>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Question<span style="color: red">*</span></label>
                                <textarea placeholder="type your question in here..." name="question"
                                          id="question" cols="24" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach(range('a', 'd') as $v)
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label class="radio">
                                            {{ strtoupper($v) }}
                                            <input type="radio" name="answer[check]" value="{{ strtoupper($v) }}"/>
                                            <span></span>
                                            <textarea
                                                class="eci-form-control"
                                                cols="50"
                                                rows="5"
                                                name="answer[txt][{{ strtoupper($v) }}]"
                                                placeholder="Type your answer in here"
                                            ></textarea>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="kt-portlet__head-wrapper">
                                        <span class="form-text text-muted">select one of answers<span
                                                style="color: red">*</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="{{ url('themes/eci/css/custom/eci-style.css') }}">
@endpush

@push('scripts')
    <script>
        $(function () {
            //$('#question').summernote();
            $('[data-toggle="tooltip"]').tooltip()
        });

    </script>
@endpush
