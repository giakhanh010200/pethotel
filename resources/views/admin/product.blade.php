<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-product.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
        <h2 class="show-header-title">Product</h2>
        <button class="btn btn-add-new" id="btnAddProduct">Add new</button>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        @if (session('error'))
            <section class='alert alert-danger'>{{ session('error') }}</section>
        @endif
        <!-- session create box add new product -->
        <div class="session-add-new-product">
            <h4 class="add-product-title">Add new product</h4>
            <form class="form-add-product" method="post" enctype="multipart/form-data"
                action="{{ route('admin.product_upload') }}">
                {{ csrf_field() }}
                <input type="text" name="name" placeholder="Enter Product name" class="form-control product-name-add"
                    required>
                <br>

                <div class="box-add-prd-content">
                    <textarea type="text" name="description" id="description"
                        class="form-control textarea-content-product"></textarea>
                    <div class="view-add-product-on-right col-5">
                        <div class="top-view-right-add">
                            <div class="box-product-scan-info">
                                <input class="form-control col-5" type="number" name="serial"
                                    placeholder="Product serial" required>
                                <input class="form-control" type="text" name="manufacturer"
                                    placeholder="Product manufacturer" required>
                            </div>
                        </div>
                        <div class="bottom-view-right-add">
                            <div class="prd-content box-content-center form-control col-5">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($array_category as $arcate)
                                            <option value="{{ $arcate->id }}">{{ $arcate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pet</label>
                                    <select class="form-control" name="pet_id" required>
                                        <option value="">Select Pet</option>
                                        @foreach ($array_pet as $arpet)
                                            <option value="{{ $arpet->id }}">{{ $arpet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Import Price</label>
                                    <div class="input-box-currency">
                                        <input type="number" name="import_price" class="form-control input-import_price"
                                            required min="1000" step="1000">
                                        <p>VNĐ</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Sale Price</label>
                                    <div class="input-box-currency">
                                        <input type="number" name="sale_price" class="form-control input-sale_price"
                                            min="1000" step="1000" required>
                                        <p>VNĐ</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control product-quantity" required>
                                </div>
                            </div>
                            <div class="prd-content box-content-right">
                                <div class="box-thumbnail-product">

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
                </div>
            </form>
        </div>
        <!-- end session -->

        <!-- session view and edit product -->
        <div class="session-view-all-product">
            <div class="search-product-content">
                <div class="search-product-content">
                    <form class="form-search">
                        <input type="text" name="search" id="search-product" placeholder="Search product ...">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="show-product-content">
                <div class="show__product__title col-12">
                    <div class="title-area header-title-items col-1">Product ID</div>
                    <div class="title-area header-title-items col-2">Product Name</div>
                    <div class="middle-at-title-prd col-6">
                        <div class="title-area header-title-items col-3">Category</div>
                        <div class="title-area header-title-items col-3">Pet</div>
                        <div class="title-area header-title-items col-3">Import Price</div>
                        <div class="title-area header-title-items col-3">Sale Price</div>
                    </div>
                    <div class="title-area header-title-items col-1">Quantity</div>
                    <div class="title-area header-title-items col-2">Action</div>
                </div>
                <div class="show__product__content">
                    @foreach ($array_products as $arprd)
                        <div class="showing__content col-12">
                            <div class="content-product-id col-1">{{ $arprd->id }}</div>
                            <div class="content-product-name col-2">{{ $arprd->name }}</div>
                            <div class="middle-at-content-prd col-6">
                                @foreach ($array_category as $arcate)
                                    @if ($arcate->id == $arprd->category_id)
                                        <div class="content-product-category col-3">{{ $arcate->name }}</div>
                                    @endif
                                @endforeach
                                @foreach ($array_pet as $arpet)
                                    @if ($arpet->id == $arprd->pet_id)
                                        <div class="content-product-category col-3">{{ $arpet->name }}</div>
                                    @endif
                                @endforeach
                                <div class="content-product-import_price col-3">{{ number_format($arprd->import_price, 0, '', '.') }} VND
                                </div>
                                <div class="content-product-sale_price col-3">{{ number_format($arprd->sale_price, 0, '', '.') }} VND
                                </div>
                            </div>
                            <div class="content-product-quantity col-1">{{ $arprd->quantity }}</div>
                            <div class="content-product-action col-2">
                                <p class="action action-view">
                                    <button type="button" class="btn btn-info btn-show">View</button>
                                </p>
                                <p class="action action-edit">
                                    <button id="showEdit{{ $arprd->id }}"
                                        class="btn btn-edit btn-warning">Edit</button>
                                </p>
                                <p class="action action-delete">
                                    <button type="button" data-target="#delete-product-{{ $arprd->id }}"
                                        data-toggle="modal" class="btn btn-product-delete btn-danger">
                                        Delete
                                    </button>
                                </p>
                            </div>
                        </div>
                        <!-- start view box edit for each product -->
                        <div class="show__edit__product" id="viewEdit{{ $arprd->id }}">
                            <div class="header-edit-product">
                                <h4 class="add-product-title">Edit product</h4>
                                <button class="btn-cancel-edit" id="cancelEdit{{ $arprd->id }}" alt="Cancel Edit">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <form class="form-add-product" method="post" enctype="multipart/form-data"
                                action="{{ route('admin.product_update', ['id' => $arprd->id]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $arprd->id }}">
                                <input type="text" name="name" value="{{ $arprd->name }}"
                                    placeholder="Enter product name"
                                    class="set-default-value product-name-add form-control" required>
                                <br>
                                <div class="box-add-prd-content">
                                    <textarea type="text" name="description" id="description"
                                        class="form-control set-default-value textarea-content-product">{{ $arprd->description }}</textarea>
                                    <div class="view-add-product-on-right col-5">
                                        <div class="top-view-right-add">
                                            <div class="box-product-scan-info">
                                                <input class="form-control col-5" type="number" name="serial"
                                                    placeholder="Product serial" value="{{ $arprd->serial }}"
                                                    required>
                                                <input class="form-control" type="text" name="manufacturer"
                                                    placeholder="Product manufacturer"
                                                    value="{{ $arprd->manufacturer }}" required>
                                            </div>
                                        </div>
                                        <div class="bottom-view-right-add">
                                            <div class="prd-content box-content-center form-control">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control set-default-value-selected"
                                                        name="category_id" required>
                                                        @foreach ($array_category as $arcate)
                                                            @if ($arprd->category_id == $arcate->id)
                                                                <option value="{{ $arcate->id }}"
                                                                    class="set-default-value-selected" selected>
                                                                    {{ $arcate->name }}</option>
                                                            @else
                                                                <option value="{{ $arcate->id }}">
                                                                    {{ $arcate->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pet</label>
                                                    <select class="form-control" name="pet_id" required>
                                                        @foreach ($array_pet as $arpet)
                                                            @if ($arprd->pet_id == $arpet->id)
                                                                <option value="{{ $arpet->id }}"
                                                                    class="set-default-value-selected" selected>
                                                                    {{ $arpet->name }}</option>
                                                            @else
                                                                <option value="{{ $arpet->id }}">
                                                                    {{ $arpet->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Import Price</label>
                                                    <div class="input-box-currency">
                                                        <input type="number" name="import_price"
                                                            class="set-default-value form-control input-import_price"
                                                            required min="1000" step="1000"
                                                            value="{{ $arprd->import_price }}">
                                                        <p>VNĐ</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sale Price</label>
                                                    <div class="input-box-currency">
                                                        <input type="number" name="sale_price"
                                                            class="set-default-value form-control input-sale_price"
                                                            min="1000" step="1000" required
                                                            value="{{ $arprd->sale_price }}">
                                                        <p>VNĐ</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity"
                                                        class="set-default-value form-control product-quantity"
                                                        value="{{ $arprd->quantity }}" required>
                                                </div>
                                            </div>
                                            <div class="prd-content box-content-right">
                                                <div class="box-thumbnail-product">

                                                    <input type="file" name="thumbnail"
                                                        id="thumbnail{{ $arprd->id }}"
                                                        class="set-default-value post-thumbnail"
                                                        placeholder="Upload thumbnail">
                                                    <img id="showImage{{ $arprd->id }}"
                                                        class="show-image-thumbnail"
                                                        src="{{ URL::asset('image/product') }}/{{ $arprd->thumbnail }}">
                                                </div>
                                                <button type="submit" class="btn-primary form-control">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- view box delete product -->
                        <!-- Start -->
                        <div class="modal shop__modal__product" id="delete-product-{{ $arprd->id }}">
                            <div class="box-product-delete">
                                <div class="modal-content">
                                    <form class="box-toggle-add" id="form-action-delete-product"
                                        action="{{ route('admin.delete_product', ['id' => $arprd->id]) }}">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="title-box-delete">Product
                                                {{ $arprd->id }}</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body modal-body-for-delete">
                                            <div class="top-body-prd-delete">
                                                <div class="box-title-right">
                                                    <div class="title-box-delete">Product Name: </div>
                                                    <div class="title-box-delete">Product Serial: </div>
                                                    <div class="title-box-delete">Manufacturer: </div>
                                                    <div class="title-box-delete">Import Price: </div>
                                                    <div class="title-box-delete">Sale Price: </div>
                                                    <div class="title-box-delete">Quantity: </div>
                                                </div>
                                                <div class="box-content-left">
                                                    <div class="content-box-delete">{{ $arprd->name }}</div>
                                                    <div class="content-box-delete">{{ $arprd->serial }}</div>
                                                    <div class="content-box-delete">{{ $arprd->manufacturer }}</div>
                                                    <div class="content-box-delete">{{ $arprd->import_price }} <p
                                                            class="currency-back-price">VNĐ</p>
                                                    </div>
                                                    <div class="content-box-delete">{{ $arprd->sale_price }} <p
                                                            class="currency-back-price">VNĐ</p>
                                                    </div>
                                                    <div class="content-box-delete">{{ $arprd->quantity }}</div>
                                                </div>
                                            </div>
                                            <div class="box-show-description">
                                                <button value="{{ $arprd->id }}"
                                                    class="view-description-btn btn btn-success" type="button">Show
                                                    Description</button>
                                                <div id="descriptionprd{{ $arprd->id }}"
                                                    class="box-description-show">
                                                    {!! $arprd->description !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#cancelEdit{{ $arprd->id }}").click(function() {
                                    $("#viewEdit{{ $arprd->id }}").hide(1000);

                                    var x = document.querySelectorAll(".set-default-value");
                                    for (var i = 0; i < x.length; i++) {
                                        x[i].value = x[i].defaultValue;
                                    }
                                    var y = document.querySelectorAll(".set-default-value-selected");
                                    for (var i = 0; i < x.length; i++) {
                                        y[i].selected = true;
                                    }


                                });


                                $("#showEdit{{ $arprd->id }}").click(function() {
                                    $(".show__edit__product").hide(1000);
                                    $("#viewEdit{{ $arprd->id }}").show(1000);

                                    var x = document.querySelectorAll(".set-default-value");
                                    for (var i = 0; i < x.length; i++) {
                                        x[i].value = x[i].defaultValue;
                                    }
                                    var y = document.querySelectorAll(".set-default-value-selected");
                                    for (var i = 0; i < x.length; i++) {
                                        y[i].selected = true;
                                    }
                                });

                                document.getElementById("thumbnail{{ $arprd->id }}").onchange = function() {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        // get loaded data and render thumbnail.
                                        document.getElementById("showImage{{ $arprd->id }}").src = e.target.result;
                                    };

                                    // read the image file as a data URL.
                                    reader.readAsDataURL(this.files[0]);
                                };
                            })
                        </script>
                    @endforeach
                </div>
            </div>
            {!! $array_products->links('layout.pagination') !!}
        </div>

        <!--end session-->

    </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/product.js') }}"></script>
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
                xhr.open('POST', '{{ route('admin.image_product_upload') }}', true);
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
