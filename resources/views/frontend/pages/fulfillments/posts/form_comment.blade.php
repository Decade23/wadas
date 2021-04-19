<form class="clearfix" action="{{ route('front_cms_posts_comments.store', $dataDb->slug) }}" method="post" id="commentform">
    {{ csrf_field() }}
    @include('frontend.layouts.shortcodes.alert')
    <div class="col_one_third">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" onblur="retrieveVisitor()" id="email" value="" size="22" tabindex="2" class="sm-form-control" />
            <small id="email_response" class="form-text text-danger hidden"></small>
        </div>
    </div>

    <div class="col_one_third">
        <div class="form-group">
            <label for="author">Name</label>
            <input type="text" name="name" id="name" value="" size="22" tabindex="1" class="sm-form-control" />
            <small id="name_response" class="form-text text-danger hidden"></small>
        </div>

    </div>

{{--    <div class="col_one_third col_last">--}}
{{--        <label for="url">Website</label>--}}
{{--        <input type="text" name="url" id="url" value="" size="22" tabindex="3" class="sm-form-control" />--}}
{{--    </div>--}}

    <div class="clear"></div>

    <div class="col_full">
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
            <small id="comment_response" class="form-text text-danger hidden"></small>
        </div>

    </div>

    <div class="col_full nobottommargin">
        <button name="submit" type="submit"  id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin">Submit Comment</button>
    </div>

</form>

@push('scripts')
    <script>
        function retrieveVisitor() {
            let path = '{{ route('front_cms_posts_get_data_visitor.show') }}';
            let email = $('#email').val();
            let name = $('#name');
            $.ajax({
                url: path,
                type: 'post',
                data: {
                    _token   : '{!! csrf_token() !!}',
                    email: email
                },
                success: (data) => {

                    if ( name.val() === '' ) {
                        name.val('');
                    }

                    if (data.success.name !== undefined) {
                        name.val(data.success.name)
                    }
                },
                before: () => {
                    name.attr('placeholder','try to get the name...');
                }

            })
        }

        $('#commentform').on('submit', (event) => {
            event.preventDefault()

            let path = $('#commentform').attr('action');
            console.log(path);
            let email = $('#email').val();
            let name = $('#name').val();
            let comment = $('#comment').val();
            $.ajax({
                url: path,
                type: 'post',
                data: {
                    _token   : '{!! csrf_token() !!}',
                    email: email,
                    name: name,
                    comment: comment,
                },
                success: (data) => {
                    $('#submit-button').text('Submit Comment').attr('disabled',false);

                    if ( typeof data.res !== undefined) {
                        empty_input()
                        $('.message_response').text(data.message)
                        $('.success_message').removeClass('hidden').focus()
                    }

                },
                error: (error) => {
                    let err = error.responseJSON

                    if ( typeof err.message !== undefined ) {
                        $('.error_message').removeClass('hidden').focus()
                        $('.message_response_error').text(err.message)
                    } else {
                        $('.error_message').addClass('hidden')
                    }

                    if ( typeof err.errors !== undefined ) {

                        // check email field
                        if ( typeof err.errors.email != undefined ) {
                            $('#email_response').removeClass('hidden')
                                .text(
                                    err.errors.email[0]
                                )
                        } else {
                            $('#email_response').addClass('hidden')
                        }

                        // check name field

                        // alert( typeof err.errors.name )

                        if ( typeof err.errors.name !== undefined ) {
                            $('#name_response').removeClass('hidden')
                                .text(
                                    err.errors.name
                                )
                        } else {
                            $('#name_response').addClass('hidden').text('')
                        }

                        // check comment field
                        if ( typeof err.errors.email != undefined ) {
                            $('#comment_response').removeClass('hidden')
                                .text(
                                    err.errors.comment
                                )
                        } else {
                            $('#comment_response').addClass('hidden')
                        }
                    }
                },
                before: () => {
                    $('#submit-button').text('processing comment...').attr('disabled',true);
                }

            })

        })

        function empty_input()
        {
            $('#email').val('');
            $('#name').val('');
            $('#comment').val('');
        }
    </script>
@endpush
