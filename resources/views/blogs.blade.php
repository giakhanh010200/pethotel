<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcomeBlog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main-header.css') }}">
    <title>Blogs page</title>
</head>

<body>
    @include('header-page')
    <div class="block-widget-view-boarding-info">
        <h1 class="title-section-showww">Blogs</h1>
        <div class="panel-block-show-blogs col-lg-12 col-md-12 col-sm-12">
            <div class="section-panel row-panel-blogs">
                @foreach ($data as $arrbg)
                    <div class="col-lg-4 col-md-6 col-sm-12 each-data-blog">
                        <div class="each-block-panel-blog">
                            <div class="blog-thumbnail thumbnail-show">
                                <a href="{{ asset('view_one_blog/' . $arrbg->title) }}">
                                    <img height="300px" src="{{ URL::asset('image/blog') }}/{{ $arrbg->thumbnail }}">
                                </a>
                            </div>
                            <div class="panel-bottom panel-under-img">
                                <div class="blog-title title-show">
                                    <a href="{{ asset('view_one_blog/' . $arrbg->title) }}">
                                        {{ $arrbg->title }}
                                    </a>
                                </div>
                                <div class="blog-updated_at updated_at-show">
                                    Updated at: {{ $arrbg->updated_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($data) > 12)
                {!! $data->links('layout.pagination') !!}
            @endif
        </div>
    </div>
    @include('footer-page')
    </div>
    </div>
</body>

</html>
