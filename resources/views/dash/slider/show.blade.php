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
                    <h4 class="card-title">Slider</h4>
                    <p class="card-description"> View <code>{{ $item->name }}</code>
                    <a class="btn btn-success" href="{{ route('admin.designs.index') }}"><I CLASS="mdi mdi-page-previous"></I>BACK</a>
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
                                <h5 class="panel-title">Name</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->name }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Image</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                <p><img onerror="this.src='{{ asset('images/no-image.png') }}'" src="{{  ($item->img) }}" class="m-auto d-block border" width="500"/></p>
                            </div>


                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Description</h5>
                            </div>

                            <div class="panel-body EN" style="padding-top:0;">
                                <textarea class="p-3 w-100 border" dir="auto" readonly>{!! $item->des !!}</textarea>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Is Accepted</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                {{ ($item->isAccepted(true)) }}
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
