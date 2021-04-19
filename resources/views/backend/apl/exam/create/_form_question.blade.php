<div class="tab-pane scroll scroll-pull" id="questionPanel" role="tabpanel" data-scroll="true"
     data-wheel-propagation="true" style="height: 350px">
    <div class="row">

        <div class="col-lg-12 exam-container">
{{--            <div class="col-lg-12">--}}
                <!--begin::Portlet-->
                <div class="kt-portlet eci-bg-exam" >
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Question <small>No.</small> <code>1</code>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-scroll" data-scroll="true" style="height: 350px">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Question<span style="color: red">*</span></label>
                                        <textarea placeholder="type your question in here..." name="question[][]"
                                                  id="question[][]" cols="24" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                                <div class="row answer-container">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    A
                                                    <input type="radio" name="radios2"/>
                                                    <span></span>
                                                    <textarea class="eci-form-control" cols="50" rows="5"
                                                              placeholder="Type your answer in here"></textarea>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                <div class="col-lg-6 kt-align-right">
                                    <button type="button"
                                            class="btn btn-sm btn-info float-right"
                                            style="background-color: #0abb87;"
                                            onclick="appendAnswer()"
                                            data-toggle="tooltip"
                                            title="Add Question!"
                                    >
                                        <i class="flaticon2-plus-1 icon-sm"></i> Add Answer
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
{{--            </div>--}}
        </div>

        <div class="col-lg-12">
            <button type="button"
                    class="btn btn-sm float-right"
                    style="color: #0abb87;"
                    onclick="appendExam()"
                    data-toggle="tooltip"
                    title="Add Question!"
            >
                <i class="flaticon2-plus-1 icon-sm"></i> Add Question
            </button>
        </div>
    </div>

{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <table class="table table-bordered table-hover">--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Question Of Exams</th>--}}
{{--                            <th width="50"></th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="exam-container">--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Question<span style="color: red">*</span></label>--}}
{{--                                        <textarea placeholder="type your question in here..." name="question[][]" id="question[][]" cols="24" rows="5" class="form-control"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Answer A<span style="color: red">*</span></label>--}}
{{--                                        <input type="text" name="answer[][]" class="form-control" id="answer[][]" placeholder="Type your answer in here" value="" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="radio-inline">--}}
{{--                                            <label class="radio">--}}
{{--                                                A--}}
{{--                                                <input type="radio" name="radios2"/>--}}
{{--                                                <span></span>--}}
{{--                                                <textarea class="eci-form-control" cols="50" rows="5" placeholder="Type your answer in here"></textarea>--}}

{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="radio-inline">--}}
{{--                                            <label class="radio">--}}
{{--                                                B--}}
{{--                                                <input type="radio" name="radios2"/>--}}
{{--                                                <span></span>--}}
{{--                                                <textarea class="eci-form-control" cols="50" rows="5" placeholder="Type your answer in here"></textarea>--}}

{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-12">--}}
{{--                                    <span class="form-text text-muted">select one of answers<span style="color: red">*</span></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                    <tfoot>--}}
{{--                        <tr>--}}
{{--                            <th> </th>--}}
{{--                            <th>--}}
{{--                                <button type="button"--}}
{{--                                        class="btn btn-sm"--}}
{{--                                        style="color: #0abb87;"--}}
{{--                                        onclick="appendExam()"--}}
{{--                                        data-toggle="tooltip"--}}
{{--                                        title="Add Question!"--}}
{{--                                >--}}
{{--                                    <i class="flaticon2-plus-1 icon-sm"></i>--}}
{{--                                </button>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                    </tfoot>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
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
        let examRowIndex = 1;
        let examAnswerRowIndex = 1;


        function nextChar(c) {
            return String.fromCharCode(c.charCodeAt(0) + 1)
        }

        function examRow(examRowIndex) {
            let examRowHtml = '';

            examRowHtml += '<tr class="exam-row-' + examRowIndex + '">';

            //question exam
            examRowHtml += '<td>';
            examRowHtml += '<textarea name=exam[][question] id="question" placeholder="type your question in here..." cols="12" rows="5" class="form-control"></textarea>';
            examRowHtml += '</td>';

            //answer exam
            examRowHtml += '<td>';
            examRowHtml += '<div class="row answer-container"></div>'
            examRowHtml += '<button type="button" class="btn btn-success" onclick="appendAnswer()">';
            examRowHtml += '<i class="flaticon2-plus-1 kt-font-hover-brand"></i>';
            examRowHtml += '</button>';
            examRowHtml += '</td>';

            //remove exam
            examRowHtml += '<td>';
            examRowHtml += '<button type="button" class="btn btn-danger btn-icon-sm" onclick="removeExam(' + examRowIndex + ')">';
            examRowHtml += '<i class="fa fa-minus"></i></button>';
            examRowHtml += '</td>';

            examRowHtml += '</tr>';

            return examRowHtml
        }

        function examAnswerRow(examAnswerRowIndex) {
            let examAnswerRowHtml = '';

            examAnswerRowHtml += '<div class="exam-answer-row-' + examAnswerRowIndex + '">';
            examAnswerRowHtml += '<input name=exam[' + examRowIndex + '][' + examAnswerRowIndex + '][question][answer] placeholder="type your answer in here..." type="text" class="form-control">';
            examAnswerRowHtml += '<input name=exam[' + examRowIndex + '][' + examRowIndex + '][question][answer][select] type="radio" value="' + examAnswerRowIndex + '" class="form-control kt-radio-inline"> this is a true answer';

            examAnswerRowHtml += '<button type="button" class="btn btn-danger btn-icon-sm" onclick="removeExamAnswer(' + examAnswerRowIndex + ')">';
            examAnswerRowHtml += '<i class="fa fa-minus"></i>';
            examAnswerRowHtml += '</button>';

            examAnswerRowHtml += '</div>';

            return examAnswerRowHtml;
        }

        function examAnswerRowCard(examRowIndex) {
            let answerHtml = '';

            //start of create answer

            // start of answer
            // examRowCardHtml += '<div class="append-answer">';
            answerHtml += '<div class="col-lg-6">';
            answerHtml += '<div class="form-group">';
            answerHtml += '<div class="radio-inline">';

            answerHtml += '<label class="radio">';
            answerHtml += 'A';
            answerHtml += '<input type="radio" name="radio_answer['+examRowIndex+']['+examAnswerRowIndex+']"/>';
            answerHtml += '<span></span>';
            answerHtml += '<textarea class="eci-form-control" cols="50" rows="5" placeholder="Type your answer in here">';
            answerHtml += '</textarea>';
            answerHtml += '</label>';

            answerHtml += '</div>';
            answerHtml += '</div>';
            answerHtml += '</div>';
            // examRowCardHtml += '</div>';
            // end of answer

            //end of create answer

            return answerHtml;
        }

        function examRowCard(examRowIndex) {
            let examRowCardHtml = '';

            //examRowCardHtml += '<div class="col-lg-12">';
            examRowCardHtml += '<div class="kt-portlet eci-bg-exam">';

            // start create head
            examRowCardHtml += '<div class="kt-portlet__head">';
            examRowCardHtml += '<div class="kt-portlet__head-label">';
            examRowCardHtml += '<h3 class="kt-portlet__head-title">Question <small>No.</small> <code>1</code></h3>';
            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';
            // end create head

            // start create body
            examRowCardHtml += '<div class="kt-portlet__body">';
            examRowCardHtml += '<div class="kt-scroll" data-scroll="true" style="height: 350px">';
            examRowCardHtml += '<div class="row">';

            // start of question
            examRowCardHtml += '<div class="col-lg-12">';
            examRowCardHtml += '<div class="form-group">';
            examRowCardHtml += '<label>Question<span style="color: red">*</span></label>';
            examRowCardHtml += '<textarea placeholder="type your question in here..." name="txt_question['+examRowIndex+'][]" id="txt_question['+examRowIndex+'][]" cols="24" rows="5" class="form-control"></textarea>';
            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';
            // end of question

            // start of answer
            ///////////////
            // end of answer

            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';
            // end create body

            // start create footer
            examRowCardHtml += '<div class="kt-portlet__foot">';
            examRowCardHtml += '<div class="kt-form__actions">';

            // start of row footer
            examRowCardHtml += '<div class="row">';

            examRowCardHtml += '<div class="col-lg-6">';
            examRowCardHtml += '<div class="kt-portlet__head-wrapper">';
            examRowCardHtml += '<span class="form-text text-muted">select one of answers<span style="color: red">*</span></span>';
            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';

            examRowCardHtml += '<div class="col-lg-6 kt-align-right">';
            examRowCardHtml += '<button type="button" class="btn btn-sm btn-info float-right" onclick="appendAnswer()" data-toggle="tooltip" title="Add Answer!" > <i class="flaticon2-plus-1 icon-sm"></i> Add Answer </button>';
            examRowCardHtml += '</div>';

            examRowCardHtml += '</div>';
            // end of row footer

            examRowCardHtml += '</div>';
            examRowCardHtml += '</div>';
            // end create footer

            examRowCardHtml += '</div>';
            //examRowCardHtml += '</div>';

            return examRowCardHtml;
        }

        function appendExam() {
            $('.exam-container').append(examRowCard(examRowIndex));

            examRowIndex++;
        }

        function appendAnswer() {
            $('.answer-container').append(examAnswerRowCard(examRowIndex));

            examAnswerRowIndex++;
        }

        function removeExam(examRowIndex) {
            $('.exam-row-' + examRowIndex).remove();
        }

        function removeExamAnswer(examAnswerRowIndex) {
            $('.exam-answer-row-' + examAnswerRowIndex).remove();
        }

        var KTLayoutStretchedCard = function () {
            // Private properties
            var _element;

            // Private functions
            var _init = function () {
                var scroll = KTUtil.find(_element, '.card-scroll');
                var cardBody = KTUtil.find(_element, '.card-body');
                var cardHeader = KTUtil.find(_element, '.card-header');

                var height = KTLayoutContent.getHeight();

                height = height - parseInt(KTUtil.actualHeight(cardHeader));

                height = height - parseInt(KTUtil.css(_element, 'marginTop')) - parseInt(KTUtil.css(_element, 'marginBottom'));
                height = height - parseInt(KTUtil.css(_element, 'paddingTop')) - parseInt(KTUtil.css(_element, 'paddingBottom'));

                height = height - parseInt(KTUtil.css(cardBody, 'paddingTop')) - parseInt(KTUtil.css(cardBody, 'paddingBottom'));
                height = height - parseInt(KTUtil.css(cardBody, 'marginTop')) - parseInt(KTUtil.css(cardBody, 'marginBottom'));

                height = height - 3;

                KTUtil.css(scroll, 'height', height + 'px');
            }

            // Public methods
            return {
                init: function (id) {
                    _element = KTUtil.getById(id);

                    if (!_element) {
                        return;
                    }

                    // Initialize
                    _init();

                    // Re-calculate on window resize
                    KTUtil.addResizeHandler(function () {
                            _init();
                        }
                    );
                },

                update: function () {
                    _init();
                }
            };
        }();

        // Webpack support
        if (typeof module !== 'undefined') {
            module.exports = KTLayoutStretchedCard;
        }


    </script>
@endpush
