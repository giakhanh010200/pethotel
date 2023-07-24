<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-service.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
        <h2 class="show-header-title">Services</h2>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        <div class="body-content-show-service">
            <div class="box-add-on-right col-5">
                <button class="btn btn-primary btn-add-service-new" id="btnAddService">
                    <i class="fas fa-plus"></i>
                </button>
                <!-- box view add new service  -->
                <div class="box-show-add-service" id="boxShowAddService">
                    <h2 class="header-show-add-title">Add new Service</h2>
                    <form class="form-horizontal form-show-add-service" method="post"
                        action="{{ route('admin.service_upload') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Name:</label>
                            <input class="form-control" type="text" name="name" placeholder="Service Name" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description:</label>
                            <textarea type="text" name="about" class="form-control" placeholder="Service Description"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price:</label>
                            <div class="box-input-currency-price">
                                <input type="number" name="price" class="form-control" placeholder="Service Price"
                                    min="100000" step="1000" required>
                                <p class="currency-back-price">VNĐ</p>
                            </div>
                        </div>
                        <div class="box-thumbnail-service form-group">
                            <input type="file" name="image" id="thumbnail" class="post-thumbnail"
                                placeholder="Upload thumbnail" required>
                            <img id="showImage" class="show-image-thumbnail">
                        </div>
                        <div class="form-group box-btn-action-form-add">
                            <button type="reset" class="btn">Reset</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                <!-- end add new -->
                <div class="services-content-quotes">
                    <p>
                        “To earn the respect (and eventually love) of your customers, you first have to respect those
                        customers. That is why Golden Rule behavior is embraced by most of the winning companies.”
                    </p>
                    <p>
                        – Colleen Barrett, Southwest Airlines President Emerita
                    </p>
                    <div class="form-statistical-services-use">
                        Bảng thống kê dịch vụ
                    </div>
                </div>
            </div>
            <div class="box-table-show-services col-7">
                <table class="table table-striped table-show-services">
                    <tr>
                        <td>ID</td>
                        <td>Thumbnail</td>
                        <td>Services</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($array_services as $arsv)
                        <tr class="show-each-services">
                            <td class="id-services-table">{{ $arsv->id }}</td>
                            <td class="thumbnail-services-table">
                                <img class="image-thumb"
                                    src="{{ URL::asset('image/service') }}/{{ $arsv->image }}">
                            </td>
                            <td class="name-services-table">
                                {{ $arsv->name }}
                            </td>
                            <td class="price-services-table">
                                <div class="box-price">
                                    {{ number_format($arsv->price, 0, '', '.') }} VND

                                </div>
                            </td>
                            <td class="action-services-table">
                                <div class="view-action">
                                    <a href="#" class="btn btn-info btn-service-detail">
                                        View
                                    </a>
                                    <button type="button" data-target="#edit-services-{{ $arsv->id }}"
                                        data-toggle="modal" class="btn btn-service-edit btn-warning">
                                        Edit
                                    </button>
                                    <button type="button" data-target="#delete-services-{{ $arsv->id }}"
                                        data-toggle="modal" class="btn btn-service-delete btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- modal edit each service -->
                        <div class="modal shop__modal__services" id="edit-services-{{ $arsv->id }}">
                            <div class="services-box-edit">
                                <div class="modal-content">
                                    <form class="box-toggle-add" method="post" id="form-action-edit-services"
                                        enctype="multipart/form-data"
                                        action="{{ route('admin.service_update', ['id' => $arsv->id]) }}">
                                        {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="title-box-edit">{{ $arsv->name }}
                                            </h2>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label">Name:</label>
                                                <input class="form-control reset-value-to-default" type="text" name="name"
                                                    placeholder="Service Name" value="{{ $arsv->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description:</label>
                                                <textarea type="text" name="about" class="reset-value-to-default form-control"
                                                    placeholder="Service Description"
                                                    required>{{ $arsv->about }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Price:</label>
                                                <div class="box-input-currency-price">
                                                    <input type="number" name="price"
                                                        value="{{ $arsv->price }}" class="reset-value-to-default form-control"
                                                        placeholder="Service Price" min="100000" step="1000" required>
                                                    <p class="currency-back-price">VNĐ</p>
                                                </div>
                                            </div>
                                            <div class="box-thumbnail-service form-group">
                                                <input type="file" name="image" id="thumbnailEdit{{ $arsv->id }}"
                                                    class="reset-value-to-default post-thumbnail" placeholder="Upload thumbnail">
                                                <img id="showImageEdit{{ $arsv->id }}"
                                                    src="{{ URL::asset('image/service') }}/{{ $arsv->image }}"
                                                    class="show-image-thumbnail">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-dismiss-edit"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="btn-update-services">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            document.getElementById("thumbnailEdit{{ $arsv->id }}").onchange = function() {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    // get loaded data and render thumbnail.
                                    document.getElementById("showImageEdit{{ $arsv->id }}").src = e.target.result;
                                };

                                // read the image file as a data URL.
                                reader.readAsDataURL(this.files[0]);
                            };
                        </script>
                        <!-- end modal edit -->

                        <!-- modal delete one service -->
                        <div class="modal shop__modal__services" id="delete-services-{{ $arsv->id }}">
                            <div class="box-services-delete">
                                <div class="modal-content">
                                    <form class="box-toggle-add" id="form-action-delete-services"
                                        action="{{ route('admin.service_delete', ['id' => $arsv->id]) }}">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="title-box-delete">Comfirm to delete Service
                                                {{ $arsv->id }}</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body modal-body-for-delete">
                                            <div class="top-body-service-delete">
                                                <div class="box-title-right">
                                                    <div class="title-box-delete">Service Name: </div>
                                                    <div class="title-box-delete">Service Price: </div>
                                                </div>
                                                <div class="box-content-left">
                                                    <div class="content-box-delete">{{ $arsv->name }}</div>
                                                    <div class="content-box-delete">{{ $arsv->price }} &nbsp; <p
                                                            class="currency-back-price">VNĐ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-show-description">
                                                <div class="title-box-delete">Description:</div>
                                                <div id="description-service-{{ $arsv->id }}"
                                                    class="box-description-show content-box-delete">
                                                    {!! $arsv->about !!}
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
                        <!-- end -->
                    @endforeach
                </table>
            </div>
        </div>



    </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/service.js') }}"></script>
</body>

</html>
