<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-shop.css') }}">

</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="shop-address-body">
        <h2 class="show-header-title">Shop</h2>
        <div id="success-message"></div>
        <form class="form-search">
            <input type="text" name="search" id="search-address" placeholder="Search store ...">
            <button class="btn-search"><i class="fas fa-search"></i></button>
        </form>
        <div class="col-12 view-add-address">
            <a href="#" class="button-show-add" id="addBtnNewAdd" data-target="#shop-address-add" data-toggle="modal">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <!-- view box add new address -->
        <!-- start-->
        <div class="modal shop__modal__address" id="shop-address-add">
            <div class="feature-box-add">
                <form class="box-toggle-add" data-url="{{ route('admin.shop_address_upload') }}"
                    id="form-action-address" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-toggle-box">Add new shop</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group group-input-for-label">
                            <label>
                                Address
                            </label>
                            <input type="text" name="address" class="form-control" id="address-add"
                                placeholder="Shop Address" required>
                        </div>
                        <div class="form-group group-input-for-label">
                            <label>
                                Open time:
                            </label>
                            <div class="time-field">
                                From
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <input type="time" class="form-control" id="address-open" name="open" value="08:00:00"
                                    disabled>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                to
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <input type="time" class="form-control" id="address-close" name="close"
                                    value="21:00:00" disabled>
                            </div>
                        </div>
                        <div class="form-group group-input-for-label">
                            <label>
                                Map address
                            </label>
                            <div class="box-map-embed">
                                <input type="text" name="map_place" class="form-control" id="address-map-place"
                                    placeholder="Google map embed" required>
                                <button type="button" class="btn-success btn btn-view-map" id="btn-view-map">
                                    View map
                                </button>
                            </div>
                            <div class="box-show-map" id="box-show-map"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-upload-address">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End -->

        <div class="table-view-shop-address" id="tableViewAddress">
            @foreach ($array_address as $adrs)
                <div class="col-12 show-view-edit-shop">
                    <div class="box-view-shop" id="view{{ $adrs->id }}" value="view{{ $adrs->id }}">
                        <div class="col-3 title-shop-address">
                            Moonlight Hotel {{ $adrs->id }}
                        </div>
                        <div class="col-5 content-shop-address" id="address-shot-add-{{ $adrs->id }}">
                            {{ $adrs->address }}
                        </div>
                        <div class="col-2 time-shop-address" id="address-shot-times-{{ $adrs->id }}">
                            {{ $adrs->open }} - {{ $adrs->close }}
                        </div>
                        <div class="col-2 action-shop-address">
                            <button type="button" value="{{ $adrs->id }}" data-target="#view-address"
                                data-toggle="modal" class="btn btn-info btn-address-detail">
                                View
                            </button>
                            <button type="button" value="{{ $adrs->id }}" data-target="#edit-address"
                                data-toggle="modal" class="btn btn-address-edit btn-warning">
                                Edit
                            </button>
                            <button type="button" value="{{ $adrs->id }}" data-target="#delete-address"
                                data-toggle="modal" class="btn btn-address-delete btn-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $array_address->links('layout.pagination') !!}
        </div>

        <!-- view box detail address -->
        <!-- Start -->
        <div class="modal shop__modal__address" id="view-address">
            <div class="address-box-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title-box-detail"></h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="body-view-detail-add">
                            <div class="body-address-detail-title">
                                <div class="title-for-times details-add-view">OPEN TIMES: </div>
                                <div class="title-for-add details-add-view">ADDRESS: </div>
                            </div>
                            <div class="body-address-detail-content">
                                <div class="details-add-view" id="body-address-times-detail"></div>
                                <div class="details-add-view" id="body-address-add-detail"></div>
                            </div>
                        </div>
                        <div class="body-address-detail-map details-add-view" id="body-address-map-detail"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->

        <!-- view box edit address -->
        <!-- Start -->
        <div class="modal shop__modal__address" id="edit-address">
            <div class="address-box-edit">
                <div class="modal-content">
                    <form class="box-toggle-add" id="form-action-edit-address">
                        <div class="modal-header">
                            <h4 class="modal-title" id="title-box-edit"></h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id-address-form-edit">
                            <div class="form-group group-input-for-label">
                                <label>
                                    Address
                                </label>
                                <input type="text" name="address" class="form-control" id="address-add-edit"
                                    placeholder="Shop Address" required>
                            </div>
                            <div class="form-group group-input-for-label">
                                <label>
                                    Open time:
                                </label>
                                <div class="time-field">
                                    From
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <input type="time" class="form-control" id="address-open-edit" name="open"
                                        value="08:00:00" disabled>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    to
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <input type="time" class="form-control" id="address-close-edit" name="close"
                                        value="21:00:00" disabled>
                                </div>
                            </div>
                            <div class="form-group group-input-for-label">
                                <label>
                                    Map address
                                </label>
                                <div class="box-map-embed">
                                    <input type="text" name="map_place" class="form-control" id="address-map-place-edit"
                                        placeholder="Google map embed" required>
                                    <button type="button" class="btn-success btn btn-view-map" id="btn-view-map-edit">
                                        View map
                                    </button>
                                </div>
                                <div class="box-show-map" id="box-show-map-edit"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="btn-update-address">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End -->

        <!-- view box delete address -->
        <!-- Start -->
        <div class="modal shop__modal__address" id="delete-address">
            <div class="box-address-delete">
                <div class="modal-content">
                    <form class="box-toggle-add" id="form-action-delete-address">
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

    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/shop_address.js') }}"></script>
</body>

</html>
