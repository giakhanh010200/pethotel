<!DOCTYPE html>
<html lang="en">
<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-pet.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet</title>
</head>
<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
        <h2 class="show-header-title">Pet List</h2>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        <div class="col-12 for-category-show">
            <div class="col-4 add-new-category-items">
                <h4 class="header-add-category">Add New Pet</h4>
                <form method="post" action="{{ route('admin.pet_upload') }}" class="form-add-new-category">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="label-input-title" for="name">
                            Pet name:
                        </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">

                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
            <div class="col-8 view-edit-category-items">
                <h4 class="header-add-category">Pet List</h4>
                @foreach ($array_pet as $ap)
                    <div class="form-group each-category-items">
                        <form method="post" class="edit-category-items form-horizontal" action="{{ route('admin.pet_update',['id'=>$ap->id]) }}">
                            {{ csrf_field() }}
                            <div class="box-edit-items">
                                <div class="form-group">
                                    <div class="id-for-label-group col-1">{{ $ap->id }}</div>
                                    <label class="form-control control-label col-2">Pet name:</label>
                                    <div class="col-9">
                                        <input type="text"
                                            class="form-edit-control input-edit{{ $ap->id }} form-control"
                                            placeholder="Category Name" value="{{ $ap->name }}" name="name"
                                            id="input{{ $ap->id }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="box-action-items active" id="action{{ $ap->id }}">
                                <button class="btn btn-edit btn-warning" id="edit{{ $ap->id }}">
                                    Edit
                                </button>
                                <a onClick="return confirmDeleteFunction()" class="btn-danger btn-delete btn"
                                    href="{{ route('admin.pet_delete', ['id' => $ap->id]) }}">
                                    Delete
                                </a>
                            </div>
                            <div class="box-button-update" id="button{{ $ap->id }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" id="cancle{{ $ap->id }}"
                                    class="btn btn-primary">Cancle</button>
                            </div>
                        </form>
                    </div>
                    <script>
                        $("#edit{{ $ap->id }}").click(function(event) {
                            event.preventDefault();
                            var x = document.querySelectorAll(".form-edit-control");
                            for (var i = 0; i < x.length; i++) {
                                x[i].value = x[i].defaultValue;
                            }
                            $(".form-edit-control").attr("disabled", "");
                            $(".box-button-update").removeClass("active");
                            $(".box-action-items").addClass("active");

                            $("#input{{ $ap->id }}").removeAttr("disabled");
                            $("#textarea{{ $ap->id }}").removeAttr("disabled");
                            $("#action{{ $ap->id }}").removeClass("active");
                            $("#button{{ $ap->id }}").addClass("active");
                        });
                        $("#cancle{{ $ap->id }}").click(function(event) {
                            event.preventDefault();
                            var x = document.querySelectorAll(".input-edit{{ $ap->id }}");
                            for (var i = 0; i < x.length; i++) {
                                x[i].value = x[i].defaultValue;
                            }
                            $(".form-edit-control").attr("disabled", "");
                            $("#button{{ $ap->id }}").removeClass("active");
                            $("#action{{ $ap->id }}").addClass("active");
                        });
                        function confirmDeleteFunction() {
                            var r = confirm("Press OK to confirm delete category?");
                            if (r == false) {
                                return false;
                            }
                        }
                    </script>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>
