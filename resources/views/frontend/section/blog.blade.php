<section id="section-blog" class="page-section">
    <div class="section nobg notopmargin notopborder">
        <div class="container clearfix">
            <div class="heading-block center nomargin">
                <h3>Latest from the Blog</h3>
            </div>
        </div>
    </div>
    <div class="container clear-bottommargin clearfix">

        <div class="row">

            <!-- checking if has posts -->
            @if( isset( $dataDb['blog'] ) && $dataDb['blog']->count() > 0 )
                <!-- looping the posts -->
                @foreach( $dataDb['blog'] as $post )
                    <!-- checking if post has permit to publish -->
                    @if( $post->visibility == 'publish' )
                        <!-- show the post for 4 row -->
                        <div class="col-lg-3 col-md-6 bottommargin">
                            <div class="ipost clearfix">
                                <!-- checking if post has media -->
                                @if( isset( $post->media ) && $post->media->count() > 0 )
                                    <div class="entry-image">
                                        <a href="{{ route('front_cms_posts.show',$post->slug) }}"><img class="image_fade" src="{{ url($post->media[0]->url ) }}" alt="Image"></a>
                                    </div>
                                @endif

                                <div class="entry-title">
                                    <h3><a href="{{ route('front_cms_posts.show',$post->slug) }}">{{ ucwords( $post->name ) }}</a></h3>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> {{ $post->post_date }}</li>
        {{--                        comment column count    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 53</a></li>--}}
                                </ul>
                                <div class="entry-content">
                                    <p>{{ $post->short_content }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- checking if post don't have permit to publish -->
                        <div class="col-lg-12 col-md-12 bottommargin">
                            <div class="entry-content">
                                <p>No Posts Available.</p>
                            </div>
                        </div>
                    @endif
                    <!-- end checking if post has permit -->
                @endforeach
                <!-- end looping the posts -->
            @else
            <!-- end checking if has posts -->
                <div class="col-lg-12 col-md-12 bottommargin">
                    <div class="entry-content">
                        <p>No Posts Available.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
