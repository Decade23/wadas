@extends('frontend.layouts.app')

@section('body')
    <!-- Page Title
		============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>Expert Club Indonesia Bisnis Manajamen - Post</h1>
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                <li class="breadcrumb-item"><a href="#">Blog</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">Blog Single</li>--}}
{{--            </ol>--}}
        </div>

    </section><!-- #page-title end -->

    <!-- Content
		============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Post Content
                ============================================= -->
                <div class="postcontent nobottommargin clearfix">

                    <div class=" single-post nobottommargin">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title">
                                <h2>{{ ucwords( $dataDb->name ) }}</h2>
                            </div><!-- .entry-title end -->

                            <!-- Entry Meta
                            ============================================= -->
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> {{ $dataDb->post_date }}</li>
                                <li><a href="#"><i class="icon-user"></i> {{ $dataDb->author->name }}</a></li>
                                <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li>
{{--                                <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>--}}
                                <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                            </ul><!-- .entry-meta end -->

                            <!-- Entry Image
                            ============================================= -->
                            <!-- checking if post has media -->
                            @if( isset( $dataDb->media ) && $dataDb->media->count() > 0 )
                                <div class="entry-image">
                                    <a href="{{ route('front_cms_posts.show',$dataDb->slug) }}"><img src="{{ url($dataDb->media[0]->url ) }}" alt="Blog Single"></a>
                                </div><!-- .entry-image end -->
                            @endif

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content notopmargin">

                                {!! $dataDb->content !!}
                                <!-- Post Single - Content End -->

                                <!-- Tag Cloud
                                ============================================= -->
                                <div class="tagcloud clearfix bottommargin">
                                    <a href="#">general</a>
                                    <a href="#">information</a>
                                    <a href="#">media</a>
                                </div><!-- .tagcloud end -->

                                <div class="clear"></div>

                                <!-- Post Single - Share
                                ============================================= -->
{{--                                @include('frontend.pages.fulfillments.posts.media_social')--}}
                                <!-- Post Single - Share End -->

                            </div>
                        </div><!-- .entry end -->

                        <!-- Post Navigation
                        ============================================= -->
                        <div class="post-navigation clearfix">

                            <div class="col_half nobottommargin">
                                <a href="#">&lArr; This is a Standard post with a Slider Gallery</a>
                            </div>

                            <div class="col_half col_last tright nobottommargin">
                                <a href="#">This is an Embedded Audio Post &rArr;</a>
                            </div>

                        </div>
                        <!-- .post-navigation end -->

                        <div class="line"></div>

                        <!-- Post Author Info
                        ============================================= -->
{{--                        <div class="card">--}}
{{--                            <div class="card-header"><strong>Posted by <a href="#">{{ ucwords( $dataDb->author->name ) }}</a></strong></div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="author-image">--}}
{{--                                    <img src="{{ asset('frontend/images/author/1.jpg') }}" alt="" class="rounded-circle">--}}
{{--                                </div>--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae ab sint earum voluptate velit beatae alias fugit accusantium laboriosam nisi reiciendis deleniti tenetur molestiae maxime id quaerat consequatur fugiat aliquam laborum nam aliquid. Consectetur, perferendis?--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- Post Single - Author End -->

{{--                        <div class="line"></div>--}}

{{--                        @include('frontend.pages.fulfillments.posts.related_posts')--}}

                        <!-- Comments
                        ============================================= -->
                        <div id="comments" class="clearfix">

                            <h3 id="comments-title"><span>3</span> Comments</h3>

                            <!-- Comments List
                            ============================================= -->
{{--                            @include('frontend.pages.fulfillments.posts.comments')--}}
                            <!-- .commentlist end -->

                            <div class="clear"></div>

                            <!-- Comment Form
                            ============================================= -->
                            <div id="respond" class="clearfix">

                                <h3>Leave a <span>Comment</span></h3>

                                @include('frontend.pages.fulfillments.posts.form_comment')

                            </div><!-- #respond end -->

                        </div><!-- #comments end -->

                    </div>

                </div><!-- .postcontent end -->

                <!-- Sidebar
                ============================================= -->
{{--                @include('frontend.pages.fulfillments.posts.sidebar_blog')--}}
                <!-- .sidebar end -->

            </div>

        </div>

    </section><!-- #content end -->
@stop

@push('slider')
@endpush

@push('css')
@endpush

@push('scripts')
@endpush
