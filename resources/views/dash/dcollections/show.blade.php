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
                    <h4 class="card-title">Design Collection View</h4>
                    {{-- <p class="card-description"> View <code>{{ $item->full_name }}</code> --}}
                    <a class="btn btn-success" href="{{ route('admin.tshirts.index') }}"><I CLASS="mdi mdi-page-previous"></I>BACK</a>
                    </p>
                    <div class="col-md-12">

                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <!-- form start -->
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">ID</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->id }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">color</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->color->name }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">size</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->tsize->name }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">qantity</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->qty }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">price</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->price }}</p>
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
