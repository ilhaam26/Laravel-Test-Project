@extends('layouts.app')

@section('template_title')
    Edit Data Employee
@endsection
@section('css')
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="path-to-datepicker-css/bootstrap-datepicker.min.css">
    <script src="path-to-datepicker-js/bootstrap-datepicker.min.js"></script>
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            @if(session('danger'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('danger') }}
                    </div>
                </div>
            @endif
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-dark">
                    <div class="card-header card-dark" >
                        <span class="card-title">Edit Data Employee</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.update', $employee->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="box box-info padding-1">
                            <div class="form-group">
                                    <label >First Name<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" placeholder="" name="first_name" value="{{$employee->first_name}}" required>
                                    {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Last Name</label>
                                    <input class="form-control" placeholder="" name="last_name" value="{{$employee->last_name}}">
                                    {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Date of Birth</label>
                                    <input type="date" class="form-control" placeholder="last name" name="date_of_birth" value="{{$employee->date_of_birth}}">
                                    {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Phone Number<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="ex:08821232..." name="phone_number" value="{{$employee->phone_number}}" required>
                                    {!! $errors->first('phone_number)', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >KTP Number / NIK<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="number" class="form-control @error('ktp_number') is-invalid @enderror" placeholder="" name="ktp_number" value="{{$employee->ktp_number}}" required>
                                    {!! $errors->first('ktp_number', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Scan KTP<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="file" class="form-control @error('ktp_photo') is-invalid @enderror" name="ktp_photo" accept="image/png, image/jpg, image/jpeg">
                                    {!! $errors->first('ktp_photo', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="image-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" placeholder="user@gmail.com" value="{{$employee->email}}" name="email">
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Province Address</label>
                                    <select class="form-control select2" name="province" id="province" style="line-height: 34px; height: 34px;">
                                        <option value="" disabled>Select Province</option>
                                        @foreach($provinces as $id => $name)
                                            <option value="{{ $id }}" @if($id == $employee->province) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >City Address</label>
                                    <select class = "form-control select2" name="city" id="city" style="line-height: 34px; height: 34px;">
                                        <option value="">Select City</option>
                                        @foreach($cities as $id => $name)
                                            <option value="{{ $id }}" @if($id == $employee->city) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Street Address</label>
                                    <input class="form-control" placeholder="" name="street" value="{{$employee->street}}">
                                    {!! $errors->first('street', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >ZIP Code</label>
                                    <input class="form-control" placeholder="" name="zip_code" value="{{$employee->zip_code}}">
                                    {!! $errors->first('zip_code', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Current Position</label>
                                    <select class="form-control" name="current_position" id="">
                                        <option value="" disabled selected>Select Position</option>
                                        @foreach($positions as $p)
                                        <option value="{{$p}}" @if($p == $employee->current_position) selected @endif>{{$p}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('current_position', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Bank Account</label>
                                    <select name="bank_account" class="form-control" id="">
                                        <option value="">Select Bank</option>
                                        @foreach($banks as $b)
                                        <option value="{{$b}}" @if($b == $employee->bank_account) selected @endif>{{$b}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('bank_account', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Bank Account Number</label>
                                    <input type="number" class="form-control" placeholder="" name="bank_account_number" value="{{$employee->bank_account_number}}">
                                    {!! $errors->first('bank_account_number', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="subject-error"></span>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" name="action" value="save"
                                        class="btn btn-dark  float-right">Save</button>
                                    <a class="btn btn-secondary" href="{{ route('employee.index') }}"> Back</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
