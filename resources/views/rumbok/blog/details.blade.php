@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
<style>
.blog-single-post {
    overflow-x: scroll;
    overflow-y: hidden;
}
</style>
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-6">
              <div class="title-page">
                <h1>{{$blog->title}}</h1>
              </div>              
          </div>
          <div class="col-lg-6">
              <div class="bread-crumb-part">
                  <ul class="bread-crumb-part-list">
                      <li>
                          <a href="{{url('/')}}">@translate(home)</a>
                      </li>
                      <li>
                        <span>{{$blog->title}}</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
    <!-- Blog Content Section -->
    <section class="blog-content-section blog-details-page padding-120">
        <div class="container">
        <div class="row d-md-none d-lg-none d-sm-block">                
                <div class="col-12">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">More <i class="fal fa-bars"></i></button>                    
                </div>
            </div>
            <div class="row d-md-none d-lg-none d-sm-block collapse" id="collapseExample">
                <div class="col-md-12">
                <div class="blog-sidebar d-lg-none d-md-none d-sm-block mt-0">
                        {{--<div class="single-widget author-widget">
                            @php
                                $user = \App\User::where('user_type','Admin')->first();
                            @endphp
                            @if($user->image != null)
                            <img src="{{filePath($user->image)}}" alt="image">
                            @endif
                            <div class="author-name margin-top-20">
                                <h4>{{$user->name}}</h4>
                            </div>
                            <div class="author-content margin-top-10 d-none">
                                Hi! I'm author of this post. Read my post, be in trend.
                            </div>
                            <div class="author-social-link margin-top-20">
                                <ul>
                                    @if(getSystemSetting('type_fb')->value != null)
                                        <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                                    class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_tw')->value != null)
                                        <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                                    class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_google')->value != null)
                                        <li><a {{getSystemSetting('type_google')->value}}><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>--}}
                        @if(request()->is('blog/posts'))
                            <div class="single-widget search-widget">
                                <div class="header-search">
                                    <form method="get" action="">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                   placeholder="@translate(Blog search)"
                                                   value="{{Request::get('search')}}">
                                            <button class="btn btn-primary" type="submit">
                                                @translate(Search)
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="single-widget recent-post-widget d-lg-block d-md-block d-sm-none d-none">
                            <div class="widget-title">
                                <h4>@translate(recent posts)</h4>
                            </div>
                            @foreach($blogs->take(4) as $blogr)
                                <div class="single-recent-post">
                                    @if($blogr->img != null)
                                    <div class="recent-post-image">
                                        <a href="{{route('blog.details',$blogr->blog_slug)}}"><img
                                                src="{{filePath($blogr->img)}}" class="img-fluid" alt="image"></a>
                                    </div>
                                    @endif
                                    <div class="recent-post-title">
                                        <div class="post-date">
                                            <a href="#!"><i class="fa fa-calendar"></i>
                                                {{Carbon\Carbon::parse($blogr->created_at)->format('d-M-Y')}}
                                            </a>
                                        </div>
                                        <h5><a href="{{route('blog.details',$blogr->blog_slug)}}">{{$blogr->title}}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="single-widget category-widget">
                            <div class="widget-title">
                                <h4>@translate(all categories)</h4>
                            </div>
                            <div class="category-items cat-itm">
                                <ul>
                                    @foreach($categories as $category)
                                    @if($category->slug=='blog')
                                        <li><a href="{{route('blog.category',$category->id)}}"
                                               class="{{$loop->index++ == 0 ? 'border-none' : null}}">
                                                {{$category->name}}
                                                ({{\App\Blog::where('category_id',$category->id)->where('is_active',1)->count()}}
                                                )</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget tag-widget">
                            <div class="widget-title">
                                <h4>@translate(tags)</h4>
                            </div>

                            <div class="tag-items">
                                
                                    @foreach(allBlogTags() as $tag)
                                        <a href="{{route('blog.tag',$tag)}}">{{$tag}}</a>
                                    @endforeach
                                
                            </div>
                        </div>
                        <div class="single-widget banner-widget d-none">
                            <div class="banner-widget-logo">
                                <a href="index.html"><img src="assets/images/logo-white.png" alt="logo"></a>
                            </div>
                            <div class="banner-widget-title text-center margin-top-20">
                                <h4>start course in yourself today</h4>
                            </div>
                            <div class="banner-widget-button text-center margin-top-30">
                                <a href="#" class="template-button">instructor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-posts">
                        <div class="blog-single-post mb-3 border shadow pb-3 different-bg-color">
                            @if($blog->img != null)
                            <div class="blog-thumbnail">
                                <img src="{{filePath($blog->img)}}" class="img-fluid w-100" alt="thumbnail">
                            </div>
                            @endif
                            <div class="blog-content-part">
                                <div class="blog-content-top py-1 px-2 bg-light mb-2">
                                    <div class="blog-date margin-right-20 text-muted small">
                                        <a href="#"><i
                                                class="fa fa-calendar"></i>{{Carbon\Carbon::parse($blog->created_at)->format('d-M-Y')}}
                                        </a>
                                    </div>
                                    <div class="blog-tag margin-right-20 small text-muted">
                                        <a href="#"><i class="fa fa-tag"></i> @foreach(json_decode($blog->tags) as $tag)
                                                {{$tag}},
                                            @endforeach</a>
                                    </div>

                                </div>
                                <div class="blog-title px-2">
                                    <h3>{{$blog->title}}</h3>
                                </div>
                                <div class="blog-conten px-2">
                                    <p>{!! $blog->body !!}</p>
                                </div>
                                <div class="content-bottom margin-top-30 d-none">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="content-bottom-tag">
                                                <ul>
                                                    <li><a href="#!">{{$blog->category->name}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 d-none">
                                            <div class="blog-social-icons">
                                                <ul>
                                                    <li><span>share:</span></li>
                                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-details-slider">
                            @foreach($blogs as $blog)
                                <div class="blog-details-single-slide">
                                    <h5><a href="{{route('blog.details',$blog->blog_slug)}}">{{$blog->title}}</a></h5>
                                </div>
                            @endforeach
                        </div>
                        <div class="related-posts mt-5">
                            <div class="blog-title mb-3">
                                <h3>@translate(related posts)</h3>
                            </div>
                            <div class="row">
                                @foreach($blogs->take(2) as $blog)
                                    <div class="col-md-6">
                                        <div class="blog-single-item border shadow-sm h-100">
                                            @if($blog->img)
                                            <div class="single-blog-image">
                                                <img src="{{filePath($blog->img)}}" class="img-fluid" alt="blog">
                                            </div>
                                            @endif
                                            {{-- <div class="blog-meta">
                                                <ul>
                                                    <li><a href="#"><i
                                                                class="fa fa-tags"></i> @foreach(json_decode($blog->tags) as $tag)
                                                                {{$tag}},
                                                            @endforeach</a></li>
                                                </ul>
                                            </div> --}}
                                            <div class="single-blog-content px-2 py-1">
                                                <h5 class="title font-weight-normal"><a
                                                        href="{{route('blog.details',$blog->blog_slug)}}">{{$blog->title}}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar d-lg-block d-md-block d-sm-none d-none">
                        {{--<div class="single-widget author-widget">
                            @php
                                $user = \App\User::where('user_type','Admin')->first();
                            @endphp
                            @if($user->image != null)
                            <img src="{{filePath($user->image)}}" alt="image">
                            @endif
                            <div class="author-name margin-top-20">
                                <h4>{{$user->name}}</h4>
                            </div>
                            <div class="author-content margin-top-10 d-none">
                                Hi! I'm author of this post. Read my post, be in trend.
                            </div>
                            <div class="author-social-link margin-top-20">
                                <ul>
                                    @if(getSystemSetting('type_fb')->value != null)
                                        <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                                    class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_tw')->value != null)
                                        <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                                    class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_google')->value != null)
                                        <li><a {{getSystemSetting('type_google')->value}}><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>--}}
                        @if(request()->is('blog/posts'))
                            <div class="single-widget search-widget">
                                <div class="header-search">
                                    <form method="get" action="">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                   placeholder="@translate(Blog search)"
                                                   value="{{Request::get('search')}}">
                                            <button class="btn btn-primary" type="submit">
                                                @translate(Search)
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="single-widget recent-post-widget">
                            <div class="widget-title">
                                <h4>@translate(recent posts)</h4>
                            </div>
                            @foreach($blogs->take(4) as $blogr)
                                <div class="single-recent-post">
                                    @if($blogr->img != null)
                                    <div class="recent-post-image">
                                        <a href="{{route('blog.details',$blogr->blog_slug)}}"><img
                                                src="{{filePath($blogr->img)}}" class="img-fluid" alt="image"></a>
                                    </div>
                                    @endif
                                    <div class="recent-post-title">
                                        <div class="post-date">
                                            <a href="#!"><i class="fa fa-calendar"></i>
                                                {{Carbon\Carbon::parse($blogr->created_at)->format('d-M-Y')}}
                                            </a>
                                        </div>
                                        <h5><a href="{{route('blog.details',$blog->blog_slug)}}">{{$blogr->title}}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="single-widget category-widget">
                            <div class="widget-title">
                                <h4>@translate(all categories)</h4>
                            </div>
                            <div class="category-items cat-itm">
                                <ul>
                                    @foreach($categories as $category)
                                    @if($category->slug=='blog')
                                        <li><a href="{{route('blog.category',$category->id)}}"
                                               class="{{$loop->index++ == 0 ? 'border-none' : null}}">
                                                {{$category->name}}
                                                ({{\App\Blog::where('category_id',$category->id)->where('is_active',1)->count()}}
                                                )</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget tag-widget">
                            <div class="widget-title">
                                <h4>@translate(tags)</h4>
                            </div>

                            <div class="tag-items">
                                
                                    @foreach(allBlogTags() as $tag)
                                        <a href="{{route('blog.tag',$tag)}}">{{$tag}}</a>
                                    @endforeach
                                
                            </div>
                        </div>
                        <div class="single-widget banner-widget d-none">
                            <div class="banner-widget-logo">
                                <a href="index.html"><img src="assets/images/logo-white.png" alt="logo"></a>
                            </div>
                            <div class="banner-widget-title text-center margin-top-20">
                                <h4>start course in yourself today</h4>
                            </div>
                            <div class="banner-widget-button text-center margin-top-30">
                                <a href="#" class="template-button">instructor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
