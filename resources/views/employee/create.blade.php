@extends('layouts.app')

@section('template_title')
    Add Employee Data
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $message }}
                    </div>
                </div>
            @endif
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
                    <div class="card-header card-dark">
                        <span class="card-title">Add Employee Data
</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ route('employee.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="form-group">
                                    <label >First Name<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" placeholder="" name="first_name" required>
                                    {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="first_name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Last Name</label>
                                    <input class="form-control" placeholder="" name="last_name" >
                                    {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="last_name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Date of Birth</label>
                                    <input type="date" class="form-control" placeholder="last name" name="date_of_birth" >
                                    {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="date_of_birth-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Phone Number<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="ex:08821232..." name="phone_number" required>
                                    {!! $errors->first('phone_number)', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="phone_number-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >KTP Number / NIK<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="number" class="form-control @error('ktp_number') is-invalid @enderror" placeholder="" name="ktp_number" required>
                                    {!! $errors->first('ktp_number', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="ktp_number-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Scan KTP<sup style="font-size: 1.5em; vertical-align: text-bottom;">*</sup></label>
                                    <input type="file" class="form-control @error('ktp_photo') is-invalid @enderror" name="ktp_photo" accept="image/png, image/jpg, image/jpeg" required>
                                    {!! $errors->first('ktp_photo', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="ktp_photo-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" placeholder="user@gmail.com" name="email">
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="email-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Province Address</label>
                                    <select class="form-control select2" name="province" id="province" style="line-height: 34px; height: 34px;">
                                        <option value="" disabled selected>Select Province</option>
                                        @foreach($provinces as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="province-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >City Address</label>
                                    <select class = "form-control select2" name="city" id="city" style="line-height: 34px; height: 34px;">
                                        <option value="">Select City</option>
                                    </select>
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="city-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Street Address</label>
                                    <input class="form-control" placeholder="" name="street" >
                                    {!! $errors->first('street', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="street-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >ZIP Code</label>
                                    <input class="form-control" placeholder="" name="zip_code" >
                                    {!! $errors->first('zip_code', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="zip_code-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Current Position</label>
                                    <select class="form-control" name="current_position" id="">
                                        <option value="" disabled selected>Select Position</option>
                                        @foreach($positions as $p)
                                        <option value="{{$p}}">{{$p}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('current_position', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="current_position-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Bank Account</label>
                                    <select name="bank_account" class="form-control" id="">
                                        <option value="">Select Bank</option>
                                        @foreach($banks as $b)
                                        <option value="{{$b}}">{{$b}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('bank_account', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="bank_account-error"></span>
                                </div>
                                <div class="form-group">
                                    <label >Bank Account Number</label>
                                    <input type="number" class="form-control" placeholder="" name="bank_account_number" >
                                    {!! $errors->first('bank_account_number', '<div class="invalid-feedback">:message</div>') !!}
                                    <span class="text-danger" id="bank_account_number-error"></span>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" name="action" value="save"
                                        class="btn bg-dark float-right" id="save">Save</button>
                                    <a class="btn btn-secondary " href="{{ route('employee.index') }}"> Back</a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Page Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnSimpan = document.getElementById("save");
        btnSimpan.addEventListener("click", function (event) {
            event.preventDefault();
            var formData = new FormData($('#myForm')[0]);

            btnSimpan.innerHTML = "saving...";

            $.ajax({
                url: '/employee/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = '/employee';
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 422) {
                        var validationErrors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(validationErrors, function (field, messages) {
                            $('#'+field+'-error').text(messages[0]);
                        });
                    } else {
                        alert('Error: ' + error);
                    }
                    setTimeout(function () {
                        btnSimpan.disabled = false;
                        btnSimpan.innerHTML = "Save";
                    }, 3000);
                }
            });
            setTimeout(function () {
                btnSimpan.disabled = true;
                btnSimpan.innerHTML = "Saved";
            }, 50);
        });
    });

</script>

<script>
$(document).ready(function() {
    $('.select2').select2();
    // Handle the change event on the province dropdown
    $('#province').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/get-cities/' + provinceId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#city').empty(); // Clear existing options
                    $('#city').append('<option value="">Select City</option>'); // Add default option
                    $.each(data, function(key, value) {
                        $('#city').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        }
    });
});
</script>
@endsection
