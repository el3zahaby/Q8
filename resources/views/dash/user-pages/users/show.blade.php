@extends('layouts.dash')

@push('plugin-styles')
    <style>
        .panel-heading {
            margin-top: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User</h4>
                    <p class="card-description"> View <code>{{ $item->full_name }}</code>
                    <a class="btn btn-success" href="{{ route('admin.users.index') }}"><I CLASS="mdi mdi-page-previous"></I>BACK</a>
                    </p>
                    <div class="col-md-12">

                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <!-- form start -->
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Id</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->id }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">First Name</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->first_name }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Last Name</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->last_name }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Age</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->age }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Email</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->email }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Phone</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->phone }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Address</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->address }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Role</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->role }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">

                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Bank Name</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->Bank_Name }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">IBAN Bank</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->IBAN_Bank }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Name On BankCard</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->name_on_BankCard }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Is Designer</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                {{ ($item->isDesigner(true)) }}
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Created At</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                {{ $item->created_at }}
                            </div>
                            <!-- panel-body -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')
@endpush
