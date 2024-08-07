@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if ($message = Session::get('berhasil'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $message }}
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                <div class="card card-dark">
                    <div class="card-header card-dark" >
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __(' Employee') }}
                            </span>

                             <div class="float-right">
                                @if(auth()->user()->can('create-employee'))
                                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-secondary float-right ml-2"  data-placement="left" >
                                        {{ __('Add Data') }}
                                    </a>
                                @endif
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="list-data" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>First Name</th>
                                        <th>Last Name</th>
										<th>Email</th>
										<th>Phone Number</th>
                                        <th>Date of Birth</th>
                                        <th>Position</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var authUserCanEditEmployee = @json(auth()->user()->can('edit-employee'));
        var authUserCanDeleteEmployee = @json(auth()->user()->can('delete-employee'));
        var authUserCanViewEmployee = @json(auth()->user()->can('view-employee'));
    </script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
@push('js_in')
    <script src="{{ asset('assets/customjs/employee/employee.js') }}"></script>
@endpush
