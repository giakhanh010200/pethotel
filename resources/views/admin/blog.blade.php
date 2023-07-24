<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-blog.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
        <h2 class="show-header-title">Blog</h2>
        <button class="btn btn-add-new" id="btnAddBlog">Add new</button>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif


        <div class="session-add-new-blog">
            <h4 class="add-blog-title">Add new blog</h4>
            <form class="form-add-blog" method="post" enctype="multipart/form-data"
                action="{{ route('admin.blog_upload') }}">
                {{ csrf_field() }}
                <input type="text" name="title" placeholder="Enter title here" class="title-add-new form-control"
                    required>
                <br>
                <div class="box-add-content">
                    <textarea type="text" name="content" id="content"
                        class="form-control textarea-content-blog"></textarea>
                    <div class="view-add-blog-right col-3">
                        <div class="box-content-right">
                            <div class="box-thumbnail-content">
                                <input type="file" name="thumbnail" id="thumbnail" class=" post-thumbnail"
                                    placeholder="Upload thumbnail" required>
                                <img id="showImage" class="show-image-thumbnail">
                            </div>
                            <button type="submit" class="btn-primary form-control">Upload</button>
                            <br>
                            <button type="reset" class="btn-primary form-control">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="session-view-all-blog">
            <div class="search-blog-content">
                <form class="form-search">
                    <input type="text" name="search" id="search-blog" placeholder="Search blogs ...">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="show-blog-content">
                <div class="show__blog__title col-12">
                    <div class="title-area header-title-items col-1">Blog ID</div>
                    <div class="title-area header-title-items col-5">Title</div>
                    <div class="title-area header-title-items col-2">Posted Date</div>
                    <div class="title-area header-title-items col-2">Updated Date</div>
                    <div class="title-area header-title-items col-2">Action</div>
                </div>
                <div class="show__blog__content">
                    @foreach ($array_blogs as $abls)
                        <div class="showing__content col-12">
                            <div class="content-blog-id col-1">{{ $abls->id }}</div>
                            <div class="content-blog-title col-5">{{ $abls->title }}</div>
                            <div class="content-blog-pd col-2">{{ $abls->created_at }}</div>
                            <div class="content-blog-pd col-2">{{ $abls->updated_at }}</div>
                            <div class="content-blog-action col-2">
                                <p class="action action-view">
                                    <button type="button" class="btn btn-info btn-show">View</button>
                                </p>
                                <p class="action action-edit">
                                    <button id="showEdit{{ $abls->id }}"
                                        class="btn btn-edit btn-warning">Edit</button>
                                </p>
                                <p class="action action-delete">
                                    <button type="button" data-target="#delete-blog{{ $abls->id }}"
                                        data-toggle="modal" class="btn btn-address-delete btn-danger">
                                        Delete
                                    </button>
                                </p>
                            </div>
                        </div>
                        <div class="show__edit__content" id="viewEdit{{ $abls->id }}">
                            <div class="header-edit-blog">
                                <h4 class="add-blog-title">Edit blog</h4>
                                <button class="btn-cancel-edit" id="cancelEdit{{ $abls->id }}" alt="Cancel Edit">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <form class="form-add-blog" method="post" enctype="multipart/form-data"
                                action="{{ route('admin.blog_update', ['id' => $abls->id]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $abls->id }}">
                                <input type="text" name="title" value="{{ $abls->title }}"
                                    placeholder="Enter title here" class="set-default-value title-add-new form-control"
                                    required>
                                <br>
                                <div class="box-add-content">
                                    <textarea type="text" name="content" id="content{{ $abls->id }}"
                                        class="set-default-value form-control textarea-content-blog">{{ $abls->content }}</textarea>
                                    <div class="view-add-blog-right col-3">
                                        <div class="box-content-right">
                                            <div class="box-thumbnail-content">
                                                <input type="file" name="thumbnail" id="thumbnail{{ $abls->id }}"
                                                    class="set-default-value post-thumbnail"
                                                    placeholder="Upload thumbnail">
                                                <img id="showImage{{ $abls->id }}"
                                                    class="set-default-value show-image-thumbnail"
                                                    src="{{ URL::asset('image/blog') }}/{{ $abls->thumbnail }}">
                                            </div>
                                            <button type="submit" class="btn-primary form-control">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- view box delete address -->
                        <!-- Start -->
                        <div class="modal shop__modal__blog" id="delete-blog{{ $abls->id }}">
                            <div class="box-address-delete">
                                <div class="modal-content">
                                    <form class="box-toggle-add" id="form-action-delete-blog"
                                        action="{{ route('admin.delete_blog', ['id' => $abls->id]) }}">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="title-box-delete">Blog {{ $abls->id }}
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body modal-body-for-delete">
                                            <div class="body-box-delete-blog">
                                                <div class="form-group">
                                                    <label>Title: &nbsp;</label>
                                                    <p>{{ $abls->title }}</p>
                                                </div>
                                                <div class="">
                                                    <label>Content: </label>
                                                    {!! $abls->content !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="btn-confirm-delete-blog">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#cancelEdit{{ $abls->id }}").click(function() {
                                    var x = document.querySelectorAll(".set-default-value");
                                    for (var i = 0; i < x.length; i++) {
                                        x[i].value = x[i].defaultValue;
                                    }
                                    $("#viewEdit{{ $abls->id }}").hide(1000);
                                });
                                $("#showEdit{{ $abls->id }}").click(function() {
                                    var x = document.querySelectorAll(".set-default-value");
                                    for (var i = 0; i < x.length; i++) {
                                        x[i].value = x[i].defaultValue;
                                    }
                                    $(".show__edit__content").hide(1000);
                                    $("#viewEdit{{ $abls->id }}").show(1000);

                                });
                            });
                            document.getElementById("thumbnail{{ $abls->id }}").onchange = function() {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    // get loaded data and render thumbnail.
                                    document.getElementById("showImage{{ $abls->id }}").src = e.target.result;
                                };

                                // read the image file as a data URL.
                                reader.readAsDataURL(this.files[0]);
                            };

                            function confirmDeleteFunction() {
                                var r = confirm("Press OK to confirm delete blog?");
                                if (r == false) {
                                    return false;
                                }
                            }
                        </script>
                    @endforeach
                </div>
            </div>
            {!! $array_blogs->links('layout.pagination') !!}
        </div>

        <!-- view box delete blog -->
        <!-- Start -->
        <div class="modal shop__modal__address" id="delete-blog">
            <div class="box-blog-delete">
                <div class="modal-content">
                    <form class="box-toggle-add" id="form-action-delete-blog">
                        <div class="modal-header">
                            <h4 class="modal-title" id="title-box-delete"></h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body modal-body-for-delete">
                            <input type="hidden" id="delete-id-opt">
                            <input type="hidden" id="id-box-view-for-delete">
                            <div id="address-at-delete-box"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary" id="btn-confirm-delete-address">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End -->
    </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/blog.js') }}"></script>
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', '{{ route('admin.image_blog_upload') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve({
                        default: response.url
                    });
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
            }
        }

        // ...

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        // ...

        var x = document.querySelectorAll("textarea");
        for (var i = 0; i < x.length; i++) {
            ClassicEditor.create(x[i], {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>
</body>

</html>
