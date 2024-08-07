@extends('layouts.app')

@section('template_title')
    Dashboard Page
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="col-lg-12 mt-2">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>Info!</h4>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                    @if (session('error'))
                        <div class="col-lg-12 mt-2">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>Info!</h4>
                                {{ session('error') }}
                            </div>
                        </div>
                @endif
                <!-- <div class="col-md-4">

                </div> -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$employee}}</h3>
                        <p>Employee</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-users"></i>
                    </div>
                    <a href="/customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$user}}</h3>

                        <p>User Registrasi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
