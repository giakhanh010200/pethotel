<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-control.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin control</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="admin-body">
        <h2 class="show-header-title">Admin</h2>
        @if (Session::has('msg-success'))
            <span class="alert-success">{{ Session::get('msg-success') }}</span>
        @endif
        <div class="alert alert-success" id="alert-success-data-user"></div>
        <div class="session-view-admin first-session">
            <div class="my-info-panel">
                <h3 class="panel-title">My Information</h3>
                <form class="form-horizontal" id="formDataAdmin">
                    <div class="panel-data">
                        <div class="each-data form-group">
                            <label for="username" class="data-title label-control col-1">Username:</label>
                            <input id="edit-user-name" class="form-control" type="text" name="username"
                                placeholder="Username..." required value="{{ $admin[0]->username }}">
                            <div class="alert alert-error" id="err-uname-change"></div>
                        </div>
                        <div class="each-data form-group">
                            <label for="email" class="data-title label-control col-1">Email:</label>
                            <input id="edit-user-email" class="form-control" type="email" name="email"
                                placeholder="Email..." required value="{{ $admin[0]->email }}">
                            <div class="alert alert-error" id="err-email-change"></div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#formChangePass">Change Password</button>
                </form>
            </div>
        </div>
        <div class="modal modal-fade modal-change-pass" id="formChangePass">
            <div class="feature-box-modal">
                <form id="modal-change-pass" class="form-toggle-passs">
                    <div class="modal-header">
                        <h4 class="title-modal">Form change password</h4>
                        <button type="button" class="close-add-add close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="old_password">Old Password:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            <div class="alert alert-danger" id="err-oldpass"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="old_password">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            <div class="alert alert-danger" id="err-newpass"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="old_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            <div class="alert alert-danger" id="err-confpass"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-change" class="btn btn-primary"
                            value="{{ $admin[0]->id }}">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel-block-button btn-change-tab-block">
            <button class="btn-change-view btn-admin-view active" id="btnAdmin">Manage Employee</button>
            <button class="btn-change-view btn-admin-view" id="btnTodo">Todos</button>
        </div>
        {{-- section todo lisst --}}
        <div class="session-view-admin section-tab third-section" id="sectionViewTodo">
            <div class="todo-list-check todo-list-action">
                <div class="col-lg-12 col-md-12 col-sm-12 panel-show-todo">
                    <div class="todo-show-list">
                        @if (Session::get('level') >= 2)
                            <div class="block-button-side-panel">
                                <button class="btn btn-default btn-my-work btn-change-todo active" id="myWorkTodo">My
                                    Works</button>
                                <button class="btn btn-default btn-my-work btn-change-todo" id="myPostWork">My Post
                                    Works</button>
                            </div>
                        @endif
                        <div class="panel-main-show panel-todo-work">
                            <div class="first-panel panel-work-list active" id="myWorkPanel">
                                @foreach ($todos_do as $tdd)
                                    @if ($tdd->end_time >= $today)
                                        <div id="wg-panel-{{ $tdd->id }}"
                                            class="col-lg-3 col-md-3 col-sm-5 block-wg-panel wg-panel-{{ $tdd->id }} each-my-work @if ($tdd->end_time == $today) active @endif @if ($tdd->done_time != null) success @endif">
                                            <div class="header-block">
                                                <div class="left-header">
                                                    <div id="myAlert{{ $tdd->id }}"
                                                        class="alert-date-today @if ($tdd->end_time == $today) active @endif">
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                                @if (session('admin_id') == $tdd->admin_up)
                                                    <div class="right-header">
                                                        <button data-target="#editMyTodo" data-toggle="modal"
                                                            class="btn-edit-work btn-edit-my-work btn"
                                                            value="{{ $tdd->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn-del-work btn" value="{{ $tdd->id }}">
                                                            &times;
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="content-block-widget">
                                                <div class="block-notes">
                                                    <div class="title-notes">Notes:</div>
                                                    <div class="content-notes" id="myNote{{ $tdd->id }}">
                                                        {!! Str::limit($tdd->notes, 50, ' ...') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-time-widget">
                                                <div class="block-start-date block-date">
                                                    <div class="title-start">Start time:</div>
                                                    <div class="content-start" id="myStart{{ $tdd->id }}">
                                                        {{ $tdd->start_time }}</div>
                                                </div>
                                                <div class="block-end-date block-date">
                                                    <div class="title-start">Finish time:</div>
                                                    <div class="content-start" id="myEnd{{ $tdd->id }}">
                                                        {{ $tdd->end_time }}</div>
                                                </div>
                                            </div>
                                            @if ($tdd->done_time == null)
                                                <button class="btn btn-check-done btn-success"
                                                    value="{{ $tdd->id }}">Done work
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($todos_do as $tdds)
                                    @if ($tdds->end_time < $today)
                                        <div id="wg-panel-{{ $tdds->id }}"
                                            class="col-lg-3 col-md-3 col-sm-5 block-wg-panel wg-panel-{{ $tdds->id }} each-my-work @if ($tdds->done_time == null) unsuccess @else success @endif">
                                            <div class="header-block">
                                                <div class="left-header">
                                                </div>
                                                @if (session('admin_id') == $tdds->admin_up)
                                                    <div class="right-header">
                                                        <button data-target="#editMyTodo" data-toggle="modal"
                                                            class="btn-edit-work btn-edit-my-work btn"
                                                            value="{{ $tdds->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn-del-work btn" value="{{ $tdds->id }}">
                                                            &times;
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="content-block-widget">
                                                <div class="block-notes">
                                                    <div class="title-notes">Notes:</div>
                                                    <div class="content-notes" id="myNote{{ $tdds->id }}">
                                                        {!! Str::limit($tdds->notes, 50, ' ...') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-time-widget">
                                                <div class="block-start-date block-date">
                                                    <div class="title-start">Start time:</div>
                                                    <div class="content-start" id="myStart{{ $tdd->id }}">
                                                        {{ $tdds->start_time }}</div>
                                                </div>
                                                <div class="block-end-date block-date">
                                                    <div class="title-start">Finish time:</div>
                                                    <div class="content-start" id="myEnd{{ $tdd->id }}">
                                                        {{ $tdds->end_time }}</div>
                                                </div>
                                            </div>
                                            @if ($tdds->done_time == null)
                                                <button class="btn btn-check-done btn-success"
                                                    value="{{ $tdds->id }}">Done work
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                                <button class="col-lg-3 col-md-3 col-sm-6 btn btn-add-my-work btn-add-todo-work"
                                    data-toggle="modal" data-target="#formMyWork" id="btnMyTodo">
                                    <i class="fas fa-plus"></i>Create new work
                                </button>
                            </div>
                            @if (Session::get('level') >= 2)
                                <div class="second-panel panel-work-list" id="myPostPanel">
                                    @foreach ($todos_post as $tdp)
                                        @if ($tdp->end_time >= $today)
                                            <div id="wg-panel-{{ $tdp->id }}"
                                                class="col-lg-3 col-md-3 col-sm-5 block-wg-panel wg-panel-{{ $tdp->id }} each-my-work @if ($tdp->end_time == $today) active @endif @if ($tdp->done_time != null) success @endif">
                                                <div class="header-block">
                                                    <div class="left-header">
                                                        <div id="myAlert{{ $tdp->id }}"
                                                            class="alert-date-today @if ($tdp->end_time == $today) active @endif">
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    @if (session('admin_id') == $tdp->admin_up)
                                                        <div class="right-header">
                                                            <button data-target="#editEmployeeTodo"
                                                                data-toggle="modal"
                                                                class="btn-edit-work btn-edit-em-work btn"
                                                                value="{{ $tdp->id }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn-del-work btn"
                                                                value="{{ $tdp->id }}">
                                                                &times;
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="content-block-widget">
                                                    <div class="block-notes">
                                                        <div class="title-notes">Notes:</div>
                                                        <div class="content-notes" id="myNote{{ $tdp->id }}">
                                                            {!! Str::limit($tdp->notes, 50, ' ...') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-time-widget">
                                                    <div class="block-start-date block-date">
                                                        <div class="title-start">Start time:</div>
                                                        <div class="content-start" id="myStart{{ $tdp->id }}">
                                                            {{ $tdp->start_time }}</div>
                                                    </div>
                                                    <div class="block-end-date block-date">
                                                        <div class="title-start">Finish time:</div>
                                                        <div class="content-start" id="myEnd{{ $tdp->id }}">
                                                            {{ $tdp->end_time }}</div>
                                                    </div>
                                                </div>
                                                @if ($tdp->done_time == null)
                                                    <button class="btn btn-check-done btn-success"
                                                        value="{{ $tdd->id }}">Done work
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach ($todos_post as $tdps)
                                        @if ($tdps->end_time < $today)
                                            <div id="wg-panel-{{ $tdps->id }}"
                                                class="col-lg-3 col-md-3 col-sm-5 block-wg-panel wg-panel-{{ $tdps->id }} each-my-work @if ($tdps->done_time == null) unsuccess @else success @endif">
                                                <div class="header-block">
                                                    <div class="left-header">
                                                    </div>
                                                    @if (session('admin_id') == $tdps->admin_up)
                                                        <div class="right-header">
                                                            <button data-target="#editEmployeeTodo"
                                                                data-toggle="modal"
                                                                class="btn-edit-work btn-edit-em-work btn"
                                                                value="{{ $tdps->id }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn-del-work btn"
                                                                value="{{ $tdps->id }}">
                                                                &times;
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="content-block-widget">
                                                    <div class="block-notes">
                                                        <div class="title-notes">Notes:</div>
                                                        <div class="content-notes" id="myNote{{ $tdps->id }}">
                                                            {!! Str::limit($tdps->notes, 50, ' ...') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-time-widget">
                                                    <div class="block-start-date block-date">
                                                        <div class="title-start">Start time:</div>
                                                        <div class="content-start" id="myStart{{ $tdps->id }}">
                                                            {{ $tdps->start_time }}</div>
                                                    </div>
                                                    <div class="block-end-date block-date">
                                                        <div class="title-start">Finish time:</div>
                                                        <div class="content-start" id="myEnd{{ $tdps->id }}">
                                                            {{ $tdps->end_time }}</div>
                                                    </div>
                                                </div>
                                                @if ($tdps->done_time == null)
                                                    <button class="btn btn-check-done btn-success"
                                                        value="{{ $tdps->id }}">Done work
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    <button
                                        class="col-lg-3 col-md-3 col-sm-6 btn btn-add-employee-work btn-add-todo-work"
                                        data-toggle="modal" data-target="#formEmployeeWork" id="btnEmployeeTodo">
                                        <i class="fas fa-plus"></i>Create new work
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal add todo --}}

        <div class="modal modal-my-work-add" id="formMyWork">
            <div class="feature-box-modal">
                <form class="form-add-todo add-todo-list" id="formAddMyTodo">
                    <div class="modal-header">
                        <h4 class="title-modal">Notes work for myself</h4>
                        <button type="button" class="close-add-add close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label label-add-work" for="notes">Todo note:</label>
                            <textarea required name="notes" class="form-control contentTodo" id="noteTodoAdd"></textarea>
                        </div>
                        <div class="row-choose-date">
                            <div class="form-group">
                                <label class="control-label label-add-work" for="start">Start date:</label>
                                <input required type="date" id="startdateTodoAdd"
                                    class="control-label label-add-work" name="start">
                                <span class="alert alert-danger" id="alertStartAdd"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-add-work" for="finish">Finish date:</label>
                                <input required type="date" id="enddateTodoAdd"
                                    class="control-label label-add-work" name="finish">
                                <span class="alert alert-danger" id="alertEndAdd"></span>
                            </div>
                        </div>
                        <input type="hidden" name="admin_do" id="admindoTodoAdd" value="{{ $admin[0]->id }}">
                        <span class="alert alert-danger" id="alertLevelAdd"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-add-add"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>



        <div class="modal modal-my-work-add" id="formEmployeeWork">
            <div class="feature-box-modal">
                <form class="form-add-todo add-todo-list" id="formAddEmployeeTodo">
                    <div class="modal-header">
                        <h4 class="title-modal">Notes work for employee</h4>
                        <button type="button" class="close-add-add close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label label-add-work" for="notes">Todo note:</label>
                            <textarea id="notedoAddE" required name="notes" class="form-control contentTodo" id="noteTodo"></textarea>

                        </div>
                        <div class="row-choose-date">
                            <div class="form-group">
                                <label class="control-label label-add-work" for="start">Start date:</label>
                                <input id="startAddE" required type="date" class="control-label label-add-work"
                                    name="start">
                                <span class="alert alert-danger" id="alertStartE"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-add-work" for="finish">Finish date:</label>
                                <input id="endAddE" required type="date" class="control-label label-add-work"
                                    name="finish">
                                <span class="alert alert-danger" id="alertEndE"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label label-add-work" for="finish">Employee doing job:</label>
                            {{-- <select name="admin_do" required class="slect-store select-booking-form"
                                id="chooseEmployee" placeholder="Choose employee ...">
                                <option class="option-choose" selected>Choose employee...
                                </option>
                                @foreach ($arr_admin as $arad)
                                    <option class="option-choose" value="{{ $arad->id }}">
                                        {{ $arad->username }}
                                    </option>
                                @endforeach
                            </select> --}}
                            <input list="chooseEmployeeAdd" id="chooseEmployee">
                            <datalist id="chooseEmployeeAdd">
                                @foreach ($arr_admin as $arad)
                                    <option class="option-choose" value="{{ $arad->id }}">
                                        {{ $arad->username }}
                                    </option>
                                @endforeach
                            </datalist>
                            <span class="alert alert-danger" id="alertEmE"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-add-add"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- modal edit todo --}}
        <div class="modal modal-my-work-add" id="editMyTodo">
            <div class="feature-box-modal">
                <form class="form-add-todo add-todo-list" id="formEditMyTodo">
                    <div class="modal-header">
                        <h4 class="title-modal">Edit notes work for myself</h4>
                        <button type="button" class="close-add-add close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label label-add-work" for="notes">Todo note:</label>
                            <textarea required name="notes" class="form-control contentTodo" id="noteTodoEdit"></textarea>
                        </div>
                        <div class="row-choose-date">
                            <div class="form-group">
                                <label class="control-label label-add-work" for="start">Start date:</label>
                                <input required type="date" id="startdateTodoEdit"
                                    class="control-label label-add-work" name="start">
                                <span class="alert alert-danger" id="alertStartEdit"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-add-work" for="finish">Finish date:</label>
                                <input required type="date" id="enddateTodoEdit"
                                    class="control-label label-add-work" name="finish">
                                <span class="alert alert-danger" id="alertEndEdit"></span>
                            </div>
                        </div>
                        <input type="hidden" name="admin_do" id="admindoTodoEdit" value="{{ $admin[0]->id }}">
                        <span class="alert alert-danger" id="alertLevelEdit"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-add-add"
                            data-dismiss="modal">Close</button>
                        <button type="submit" id="btnMyWorkEditSubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>



        <div class="modal modal-my-work-add" id="editEmployeeTodo">
            <div class="feature-box-modal">
                <form class="form-add-todo add-todo-list" id="formEditEmployeeTodo">
                    <div class="modal-header">
                        <h4 class="title-modal">Edit notes work for employee</h4>
                        <button type="button" class="close-add-add close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label label-add-work" for="notes">Todo note:</label>
                            <textarea id="notedoEditE" required name="notes" class="form-control contentTodo" id="noteTodoEmEdit"></textarea>

                        </div>
                        <div class="row-choose-date">
                            <div class="form-group">
                                <label class="control-label label-add-work" for="start">Start date:</label>
                                <input id="startEditE" required type="date" class="control-label label-add-work"
                                    name="start">
                                <span class="alert alert-danger" id="alertStartEmEdit"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-add-work" for="finish">Finish date:</label>
                                <input id="endEditE" required type="date" class="control-label label-add-work"
                                    name="finish">
                                <span class="alert alert-danger" id="alertEndEmEdit"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label label-add-work" for="finish">Employee doing job:</label>
                            {{-- <select name="admin_do" required class="slect-store select-booking-form"
                                id="chooseEmployeeEdit" placeholder="Choose employee ...">
                                <option class="option-choose" selected>Choose employee...
                                </option>
                                @foreach ($arr_admin as $arad)
                                    <option class="option-choose" value="{{ $arad->id }}">
                                        {{ $arad->username }}
                                    </option>
                                @endforeach
                            </select> --}}
                            <input list="chooseEmployeeEdit" id="inputEmployeeEdit">
                            <datalist id="chooseEmployeeEdit">
                                @foreach ($arr_admin as $arade)
                                    <option class="option-choose" value="{{ $arade->id }}">
                                        {{ $arade->username }}
                                    </option>
                                @endforeach
                            </datalist>
                            <span class="alert alert-danger" id="alertLevelEmEdit"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-add-add"
                            data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEmWorkEditSubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>


        {{-- admin list section --}}
        <div class="session-view-admin active section-tab second-section" id="sectionViewAdmin">
            @if (Session::get('level') >= 3)
                <div class="search-product-content">
                    <div class="search-product-content">
                        <form class="form-search">
                            <input type="text" name="search" id="search-product" placeholder="Find admin ...">
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            @endif
            <div class="data-list-admin admin-table-view">
                <div class="col-lg-12 col-sm-12 col-md-12 panel-show-admin panel_show">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-add-new">
                        <div class="panel-add add-new-admin">
                            <h3 class="title-block-panel">Create new admin</h3>
                            <form class="form-horizontal form-add-new-admin" id="addNewAdmin" method="post"
                                action="{{ route('admin.create_new_admin') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label label-add" for="username">Username:</label>
                                    <input type="name" name="username" class="form-control" id="nameAdmin">
                                    @if ($errors->has('username'))
                                        <span class="alert-error" id="err-name-regis">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-add" for="username">Email:</label>
                                    <input type="email" name="email" class="form-control" id="nameEmail">
                                    @if ($errors->has('email'))
                                        <span class="alert-error" id="err-name-regis">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-add" for="username">Level:</label>
                                    <input type="number" name="level" class="form-control" id="nameLevel">
                                    @if ($errors->has('level'))
                                        <span class="alert-error" id="err-name-regis">
                                            {{ $errors->first('level') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-add" for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" id="namePass">
                                    @if ($errors->has('password'))
                                        <span class="alert-error" id="err-name-regis">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-add" for="password_confirm">Confirm
                                        password:</label>
                                    <input type="password" name="password_confirm" class="form-control"
                                        id="nameCfPass">
                                    @if ($errors->has('password_confirm'))
                                        <span class="alert-error" id="err-name-regis">
                                            {{ $errors->first('password_confirm') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 table-list-view-admin">
                        <div class="block-panel-view">
                            @foreach ($arr_admin as $ara)
                                <div class="widget-view-each" id="widgetView{{ $ara->id }}">
                                    <form class="form-horizontal form-change-admin"
                                        id="formAdmin{{ $ara->id }}">
                                        <div class="block-info col-lg-10 col-md-10 col-sm-12">
                                            <div class="each-panel">
                                                <label class="panel-title col-2">Username:</label>
                                                <input type="name" disabled id="name{{ $ara->id }}"
                                                    class="panel-content form-control input-{{ $ara->id }} inactive"
                                                    value="{{ $ara->username }}">
                                            </div>
                                            <div class="alert all-danger-{{ $ara->id }} alert-danger"
                                                id="alertEditName{{ $ara->id }}"></div>
                                            <div class="each-panel">
                                                <label class="panel-title col-2">Email:</label>
                                                <input type="email" id="email{{ $ara->id }}" disabled
                                                    class="panel-content form-control input-{{ $ara->id }} inactive"
                                                    value="{{ $ara->email }}">
                                            </div>
                                            <div class="alert all-danger-{{ $ara->id }} alert-danger"
                                                id="alertEditEmail{{ $ara->id }}"></div>
                                            <div class="each-panel">
                                                <label class="panel-title col-2">Level:</label>
                                                <input type="number" id="level{{ $ara->id }}" disabled
                                                    class="panel-content form-control input-{{ $ara->id }} inactive"
                                                    value="{{ $ara->level }}">
                                            </div>
                                            <div class="alert all-danger-{{ $ara->id }} alert-danger"
                                                id="alertEditLevel{{ $ara->id }}"></div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="block-button-default block-button "
                                                id="buttonDefault{{ $ara->id }}">
                                                <button type="button" class="btn btn-warning btn-click-edit"
                                                    id="btn-edit-{{ $ara->id }}"
                                                    value="{{ $ara->id }}">Edit</button>
                                                <button type="button" class="btn btn-danger btn-click-delete"
                                                    id="btn-delete-{{ $ara->id }}"
                                                    value="{{ $ara->id }}">Delete</button>
                                            </div>
                                            <div class="block-button-edit block-button "
                                                id="buttonEdit{{ $ara->id }}">
                                                <button type="button" class="btn btn-warning btn-click-save-edit"
                                                    id="btn-edit-{{ $ara->id }}"
                                                    value="{{ $ara->id }}">Save</button>
                                                <button type="reset" class="btn btn-danger btn-click-cancle"
                                                    id="btn-delete-{{ $ara->id }}"
                                                    value="{{ $ara->id }}">Cancle</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        @if (count($arr_admin) > 5)
                            {!! $arr_admin->links('layout.pagination') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/admin-control.js') }}"></script>
    <script type="text/javascript">
        var thisUrl = "{{ route('admin.admin_control') }}"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // new TomSelect("#chooseEmployee", {
        //     create: false,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // });
        // new TomSelect("#chooseEmployeeEdit", {
        //     create: false,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // });
        $(".alert").hide();
        $(".block-button-edit").hide();
        $("#formDataAdmin").submit(function(event) {
            event.preventDefault();
            var id = "{{ $admin[0]->id }}";
            var url = "/users/change_account_prof/" + id;
            data = {
                username: $("#edit-user-name").val(),
                email: $("#edit-user-email").val(),
            };
            $.ajax({
                type: "put",
                url: url,
                data: data,
                success: function(response) {
                    console.log(response.data);
                    console.log(response.msg_n);
                    console.log(response.msg_e);
                    document.getElementById("err-uname-change").innerHTML =
                        response.msg_n;
                    document.getElementById("err-email-change").innerHTML =
                        response.msg_e;
                    // $("#btn-cancle-edit-email").hide();
                    // $("#btn-cancle-edit-name").hide();
                    // $("#btn-edit-email").show();
                    // $("#btn-edit-name").show();
                    // $("#edit-user-name").attr("disabled", "disabled");
                    // $("#edit-user-email").attr("disabled", "disabled");
                    if (response.msg_n == "" && response.msg_e == "") {
                        document.getElementById("edit-user-email").value =
                            response.data.email;
                        document.getElementById("edit-user-name").value =
                            response.data.username;
                        document.getElementById("alert-success-data-user").innerHTML =
                            "data change successfully";
                        $("#alert-success-data-user").show();
                    }
                },
            });
        });

        $("#modal-change-pass").submit(function(e) {
            e.preventDefault();
            var id = $("#btn-submit-change").val();
            url = "/users/change_new_password/" + id;
            data = {
                old_password: $("#old_password").val(),
                new_password: $("#new_password").val(),
                confirm_password: $("#confirm_password").val(),
            };
            $.ajax({
                type: "put",
                url: url,
                data: data,
                success: function(response) {
                    console.log(response.msg_o);
                    document.getElementById("err-oldpass").innerHTML =
                        response.msg_o;
                    document.getElementById("err-newpass").innerHTML =
                        response.msg_n;
                    document.getElementById("err-confpass").innerHTML =
                        response.msg_c;
                    if (response.err == false) {
                        $(".alert").hide();
                        $("#alert-success-data-user").show();
                        $(".modal").hide();
                        $(".modal-backdrop.show").hide();
                        document.getElementById(
                            "alert-success-data-user"
                        ).innerHTML = "password change successfully";
                    }
                },
            });
        });
    </script>
</body>

</html>
