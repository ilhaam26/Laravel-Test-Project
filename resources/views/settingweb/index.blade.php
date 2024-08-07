@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('template_title')
    Setting Web
@endsection

@section('content')
    <div class="content">
        <div class="container-fluit">
            <div class="row">
                @if (session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                <div class="col-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Setting</h3>
                        </div>
                        @foreach ($data as $row)
                            <form method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">App Name</label>
                                                <input type="text" class="form-control" name="app_name"
                                                    value="{{ $row->app_name }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">App Alias Name</label>
                                                <input type="text" class="form-control" name="app_alias"
                                                    value="{{ $row->app_alias }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sidebar Type</label>
                                                <select name="sidebar_type" class="form-control">
                                                    <option value="dark"
                                                        @if ($row->sidebar_type == 'dark') selected @endif>dark</option>
                                                    <option value="light"
                                                        @if ($row->sidebar_type == 'light') selected @endif>light</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sidebar Mode</label>
                                                <select name="sidebar_mode" class="form-control">
                                                    <option value="">default</option>
                                                    <option value="sidebar-collapse"
                                                        @if ($row->sidebar_mode == 'sidebar-collapse') selected @endif>sidebar-collapse</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Navbar Color</label>
                                                <select name="navbar_color" class="form-control">
                                                    <option class="bg-primary" value="primary"
                                                        @if ($row->navbar_color == 'primary') selected @endif>primary</option>
                                                    <option class="bg-secondary" value="secondary"
                                                        @if ($row->navbar_color == 'secondary') selected @endif>secondary</option>
                                                    <option class="bg-info" value="info"
                                                        @if ($row->navbar_color == 'info') selected @endif>info</option>
                                                    <option class="bg-success" value="success"
                                                        @if ($row->navbar_color == 'success') selected @endif>success</option>
                                                    <option class="bg-danger" value="danger"
                                                        @if ($row->navbar_color == 'danger') selected @endif>danger</option>
                                                    <option class="bg-indigo" value="indigo"
                                                        @if ($row->navbar_color == 'indigo') selected @endif>indigo</option>
                                                    <option class="bg-purple" value="purple"
                                                        @if ($row->navbar_color == 'purple') selected @endif>purple</option>
                                                    <option class="bg-pink" value="pink"
                                                        @if ($row->navbar_color == 'pink') selected @endif>pink</option>
                                                    <option class="bg-navy" value="navy"
                                                        @if ($row->navbar_color == 'navy') selected @endif>navy</option>
                                                    <option class="bg-lightblue" value="lightblue"
                                                        @if ($row->navbar_color == 'lightblue') selected @endif>lightblue
                                                    </option>
                                                    <option class="bg-teal" value="teal"
                                                        @if ($row->navbar_color == 'teal') selected @endif>teal</option>
                                                    <option class="bg-cyan" value="cyan"
                                                        @if ($row->navbar_color == 'cyan') selected @endif>cyan</option>
                                                    <option class="bg-dark" value="dark"
                                                        @if ($row->navbar_color == 'dark') selected @endif>dark</option>
                                                    <option class="bg-gray" value="gray"
                                                        @if ($row->navbar_color == 'gray') selected @endif>gray</option>
                                                    <option class="bg-light" value="light"
                                                        @if ($row->navbar_color == 'light') selected @endif>light</option>
                                                    <option class="bg-warning" value="warning"
                                                        @if ($row->navbar_color == 'warning') selected @endif>warning</option>
                                                    <option class="bg-orange" value="orange"
                                                        @if ($row->navbar_color == 'orange') selected @endif>orange</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Navbar Type</label>
                                                <select name="navbar_type" class="form-control">
                                                    <option value="dark"
                                                        @if ($row->navbar_type == 'dark') selected @endif>dark</option>
                                                    <option value="light"
                                                        @if ($row->navbar_type == 'light') selected @endif>light</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Brand Logo Bg Color</label>
                                                <select name="brand_logo_bg_color" class="form-control">
                                                    <option class="bg-primary" value="primary"
                                                        @if ($row->logo_bg_color == 'primary') selected @endif>primary</option>
                                                    <option class="bg-secondary" value="secondary"
                                                        @if ($row->logo_bg_color == 'secondary') selected @endif>secondary
                                                    </option>
                                                    <option class="bg-info" value="info"
                                                        @if ($row->logo_bg_color == 'info') selected @endif>info</option>
                                                    <option class="bg-success" value="success"
                                                        @if ($row->logo_bg_color == 'success') selected @endif>success</option>
                                                    <option class="bg-danger" value="danger"
                                                        @if ($row->logo_bg_color == 'danger') selected @endif>danger</option>
                                                    <option class="bg-indigo" value="indigo"
                                                        @if ($row->logo_bg_color == 'indigo') selected @endif>indigo</option>
                                                    <option class="bg-purple" value="purple"
                                                        @if ($row->logo_bg_color == 'purple') selected @endif>purple</option>
                                                    <option class="bg-pink" value="pink"
                                                        @if ($row->logo_bg_color == 'pink') selected @endif>pink</option>
                                                    <option class="bg-navy" value="navy"
                                                        @if ($row->logo_bg_color == 'navy') selected @endif>navy</option>
                                                    <option class="bg-lightblue" value="lightblue"
                                                        @if ($row->logo_bg_color == 'lightblue') selected @endif>lightblue
                                                    </option>
                                                    <option class="bg-teal" value="teal"
                                                        @if ($row->logo_bg_color == 'teal') selected @endif>teal</option>
                                                    <option class="bg-cyan" value="cyan"
                                                        @if ($row->logo_bg_color == 'cyan') selected @endif>cyan</option>
                                                    <option class="bg-dark" value="dark"
                                                        @if ($row->logo_bg_color == 'dark') selected @endif>dark</option>
                                                    <option class="bg-gray" value="gray"
                                                        @if ($row->logo_bg_color == 'gray') selected @endif>gray</option>
                                                    <option class="bg-light" value="light"
                                                        @if ($row->logo_bg_color == 'light') selected @endif>light</option>
                                                    <option class="bg-warning" value="warning"
                                                        @if ($row->logo_bg_color == 'warning') selected @endif>warning</option>
                                                    <option class="bg-orange" value="orange"
                                                        @if ($row->logo_bg_color == 'orange') selected @endif>orange</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Brand Text Type</label>
                                                <select name="brand_type" class="form-control">
                                                    <option value="dark"
                                                        @if ($row->brand_type == 'dark') selected @endif>dark</option>
                                                    <option value="light"
                                                        @if ($row->brand_type == 'light') selected @endif>light</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">App Logo</label>
                                                <input type="file" class="form-control" name="app_logo"
                                                    accept="image/png, image/jpg, image/jpeg">
                                                <a href="{{asset('/images/setting/'.$row->app_logo)}}" target="blank()"> <i class="fas fa-image"></i> Old Logo</a>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$row->id}}" name="kode">
                                        <input type="hidden" value="{{$row->app_logo}}" name="old_logo">
                                </div>
                                <div class="card-footer">
                                    <button type="reset" onclick="history.go(-1)"
                                        class="btn btn-secondary">Back</button>
                                    <button type="submit" class="btn btn-dark float-right">Save</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@push('js_in')
    <script src="{{ asset('assets/customjs/users/users_input.js') }}"></script>
@endpush
