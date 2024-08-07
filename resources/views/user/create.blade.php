@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection


@section('content')
    <div class="content">
        <div class="container-fluit">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header card-dark" >
                            <h3 class="card-title">Add Users</h3>
                        </div>
                        <form method="POST" onsubmit="return validasiinput();" role="form" enctype="multipart/form-data"
                            action="{{ url('/users') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control {{$errors->has('username') ? ' is-invalid' : ''}}" name="username" required autofocus>
                                            {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control {{$errors->has('nama') ? ' is-invalid' : ''}}" name="nama" required >
                                            {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control {{$errors->has('email') ? ' is-invalid' : ''}}" name="email" required>
                                            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Level</label>
                                            <select name="level" class="form-control {{$errors->has('level') ? ' is-invalid' : ''}} select2bs4">
                                                @foreach ($roles as $row_roles)
                                                    <option value="{{ $row_roles->id }}-{{ $row_roles->name }}">
                                                        {{ $row_roles->name }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('level', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="password" class="form-control {{$errors->has('userpassword') ? ' is-invalid' : ''}}" id="password" name="userpassword"
                                                autocomplete="new-password" required>
                                            {!! $errors->first('userpassword', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Confirm Password</label>
                                            <input type="password" class="form-control {{$errors->has('kpassword') ? ' is-invalid' : ''}}" id="kpassword" name="kpassword" required>
                                            {!! $errors->first('kpassword', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-secondary">Back</button>
                                <button type="submit" class="btn btn-dark float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
         $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
         })
    </script>
@endsection

@push('js_in')
    <script src="{{ asset('assets/customjs/users/users_input.js') }}"></script>
@endpush
