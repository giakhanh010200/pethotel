<!DOCTYPE html>
<html lang="en">
<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/singleBlog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">
    <title>{{ $single[0]->title }}</title>
</head>
<body>
    @include('header-page')
    <div class="block-widget-view-boarding-info">
        <h1 class="title-section-showww">Blog information</h1>
        <div class="panel-section section-view-single">
            <div class="block-panel-section col-lg-12 col-md-12 col-md-12">
                <div class="section-panel-block right-panel-section col-lg-9 col-md-9 col-sm-12">
                    <div class="panel-thumbnail section-thumb-top">
                        <img height="500px"
                                        src="{{ URL::asset('image/blog') }}/{{ $single[0]->thumbnail }}">
                    </div>
                    <div class="panel-content section-panel-bottom">
                        <div class="panel-title">
                            <h2 class="title-panel-heading">{{ $single[0]->title }}</h2>
                            <span class="text-sub-htitle">Updated at {{ $single[0]->updated_at }}</span>
                        </div>
                        <div class="panel-content">
                            {!!  $single[0]->content !!}
                        </div>
                    </div>
                </div>
                <div class="section-panel-block left-panel-section col-lg-3 col-md-3 col-sm-12">
                    @foreach ($data as $dt)
                        <div class="each-block-blog">
                            <div class="title-thumbnail">
                                <a href="{{ asset('view_one_blog/' . $dt->title) }}">
                                    <img height="200px" src="{{ URL::asset('image/blog') }}/{{ $dt->thumbnail }}">
                                </a>
                            </div>
                            <div class="title-blogs">
                                <a href="{{ asset('view_one_blog/' . $dt->title) }}">
                                    {{ $dt->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
</body>
</html>
