@extends('layouts.app')

@section('template_title')
   Detail Employee
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header card-dark" >
                        <div class="float-left">
                            <span class="card-title">Detail Employee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-secondary" href="{{ route('employee.index') }}"> Back</a>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="box box-info padding-1">
                                <div class="form-group" style="text-align: center; margin-bottom: 20px;">
                                    <strong>Scan KTP</strong>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        @if($employee->ktp_photo)
                                            <img src="{{$employee->ktp_photo}}" alt="KTP" class="img-fluid" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                                            <a href="https://drive.google.com/file/d/{{$fileId}}/view?usp=sharing" target="_blank">Open File</a>
                                        @else
                                            <p>No photo available</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <strong >First Name</strong>
                                    <input class="form-control @error('first_name') is-invalid @enderror" placeholder="" name="first_name" value="{{$employee->first_name}}" disabled>
                                </div>
                                <div class="form-group">
                                <strong >Last Name</strong>
                                    <input class="form-control" disabled placeholder="" name="last_name" value="{{$employee->last_name}}">
                            
                                </div>
                                <div class="form-group">
                                    <strong >Date of Birth</strong>
                                    <input disabled class="form-control" placeholder="last name" name="date_of_birth" value="{{$employee->date_of_birth}}">
                                </div>
                                <div class="form-group">
                                    <strong >Phone Number</strong>
                                    <input disabled class="form-control @error('phone_number') is-invalid @enderror" placeholder="ex:08821232..." name="phone_number" value="{{$employee->phone_number}}" required>
                                    
                                </div>
                                <div class="form-group">
                                    <strong >KTP Number / NIK</strong>
                                    <input disabled class="form-control @error('ktp_number') is-invalid @enderror" placeholder="" name="ktp_number" value="{{$employee->ktp_number}}" required>
                                   
                                </div>
                                <div class="form-group">
                                    <strong >Email Address</strong>
                                    <input disabled class="form-control @error('email') is-invalid @enderror" placeholder="user@gmail.com" value="{{$employee->email}}" name="email">
                                   
                                </div>
                                <div class="form-group">
                                    <strong >Province Address</strong>
                                    <input disabled class="form-control @error('province') is-invalid @enderror"  value="{{ $province->name }}" name="province">
                                </div>
                                <div class="form-group">
                                    <strong >City Address</strong>
                                    <input disabled class="form-control @error('city') is-invalid @enderror"  value="{{$city->name}}" name="city">
                                </div>
                                <div class="form-group">
                                    <strong >Street Address</strong>
                                    <input class="form-control" placeholder="" name="street" disabled value="{{$employee->street}}">
                                    
                                </div>
                                <div class="form-group">
                                    <strong >ZIP Code</strong>
                                    <input class="form-control" disabled placeholder="" name="zip_code" value="{{$employee->zip_code}}">
                                    
                                </div>
                                <div class="form-group">
                                    <strong >Current Position</strong>
                                    <input disabled class="form-control @error('current_position') is-invalid @enderror"  value="{{$employee->current_position}}" name="current_position">
                                </div>
                                <div class="form-group">
                                    <strong >Bank Account</strong>
                                    <input disabled class="form-control @error('bank_account') is-invalid @enderror"  value="{{$employee->bank_account}}" name="bank_account">
                                </div>
                                <div class="form-group">
                                    <strong >Bank Account Number</strong>
                                    <input disabled type="number" class="form-control" placeholder="" name="bank_account_number" value="{{$employee->bank_account_number}}">
                                </div>
                                <div class="form-group">
                                    <strong >Created at</strong>
                                    <input disabled  class="form-control" placeholder="" name="created_at" value="{{$employee->created_at->format('d M Y H:i:s')}}">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection

