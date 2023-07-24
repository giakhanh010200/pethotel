<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-category.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="blogs-body">
        <h2 class="show-header-title">Category</h2>
        @if (session('msg'))
            <section class='alert alert-success'>{{ session('msg') }}</section>
        @endif
        <div class="col-12 for-category-show">
            <div class="col-4 add-new-category-items">
                <h4 class="header-add-category">Add New Category</h4>
                <form method="post" action="{{ route('admin.category_upload') }}" class="form-add-new-category">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="label-input-title" for="name">
                            Category name:
                        </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="label-input-title" for="description">
                            Description:
                        </label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>
            <div class="col-8 view-edit-category-items">
                @foreach ($array_cate as $ac)
                    <div class="form-group each-category-items">
                        <form method="post" class="edit-category-items form-horizontal" action="{{ route('admin.category_update',['id'=>$ac->id]) }}">
                            {{ csrf_field() }}
                            <div class="box-edit-items">
                                <div class="form-group">
                                    <label class="form-control control-label col-2">Name: </label>
                                    <div class="col-10">
                                        <input type="text"
                                            class="form-edit-control input-edit{{ $ac->id }} form-control"
                                            placeholder="Category Name" value="{{ $ac->name }}" name="name"
                                            id="input{{ $ac->id }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control control-label col-2">Description: </label>
                                    <div class="col-10">
                                        <textarea class="form-edit-control input-edit{{ $ac->id }} form-control"
                                            id="textarea{{ $ac->id }}" placeholder="Description"
                                            name="description" disabled>{{ $ac->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="box-action-items active" id="action{{ $ac->id }}">
                                <button class="btn btn-edit btn-warning" id="edit{{ $ac->id }}">
                                    Edit
                                </button>
                                <a onClick="return confirmDeleteFunction()" class="btn-danger btn-delete btn"
                                    href="{{ route('admin.delete_category', ['id' => $ac->id]) }}">
                                    Delete
                                </a>
                            </div>
                            <div class="box-button-update" id="button{{ $ac->id }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" id="cancle{{ $ac->id }}"
                                    class="btn btn-primary">Cancle</button>
                            </div>
                        </form>
                    </div>
                    <script>
                        $("#edit{{ $ac->id }}").click(function(event) {
                            event.preventDefault();
                            var x = document.querySelectorAll(".form-edit-control");
                            for (var i = 0; i < x.length; i++) {
                                x[i].value = x[i].defaultValue;
                            }
                            $(".form-edit-control").attr("disabled", "");
                            $(".box-button-update").removeClass("active");
                            $(".box-action-items").addClass("active");

                            $("#input{{ $ac->id }}").removeAttr("disabled");
                            $("#textarea{{ $ac->id }}").removeAttr("disabled");
                            $("#action{{ $ac->id }}").removeClass("active");
                            $("#button{{ $ac->id }}").addClass("active");
                        });
                        $("#cancle{{ $ac->id }}").click(function(event) {
                            event.preventDefault();
                            var x = document.querySelectorAll(".input-edit{{ $ac->id }}");
                            for (var i = 0; i < x.length; i++) {
                                x[i].value = x[i].defaultValue;
                            }
                            $(".form-edit-control").attr("disabled", "");
                            $("#button{{ $ac->id }}").removeClass("active");
                            $("#action{{ $ac->id }}").addClass("active");
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
</body>

</html>
