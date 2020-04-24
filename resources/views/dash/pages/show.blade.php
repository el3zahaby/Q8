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
                    <h4 class="card-title">Page View</h4>
                    {{-- <p class="card-description"> View <code>{{ $item->full_name }}</code> --}}
                    <a class="btn btn-success" href="{{ route('admin.pages.index') }}"><I CLASS="mdi mdi-page-previous"></I>BACK</a>
                    </p>
                    <div class="col-md-12">

                        <?php

                            $ar_page = $item->ar()
                            // print_r($ar_page);
                        ?>
                        <div class="btn-group my-3" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary" id="EN">EN</button>
                            <button type="button" class="btn btn-primary" id="AR">AR</button>
                        </div>

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
                            <div class="panel-heading EN" style="border-bottom:0;">
                                <h5 class="panel-title">Title EN :</h5>
                            </div>

                            <div class="panel-body EN" style="padding-top:0;">
                                <p>{{ $item->title }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading AR" style="border-bottom:0;">
                                <h5 class="panel-title">Title AR :</h5>
                            </div>

                            <div class="panel-body AR" style="padding-top:0;">
                                <p>{{ $ar_page->title }}</p>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading EN" style="border-bottom:0;">
                                <h5 class="panel-title">Body EN :</h5>
                            </div>

                            <div class="panel-body EN" style="padding-top:0;">
                            <div class="p-3 border">{!! $item->body !!}</div>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading AR" style="border-bottom:0;">
                                <h5 class="panel-title">Body AR :</h5>
                            </div>

                            <div class="panel-body AR" style="padding-top:0;">
                                <div class="p-3 border">{!! $ar_page->body !!}</div>
                            </div>
                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Excerpt :</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                            <p>{{ $item->excerpt }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Meta Keywords :</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                            <p>{{ $item->meta_keywords }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Meta Description :</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                            <p>{{ $item->meta_description }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Status :</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                            <p>{{ $item->status }}</p>
                            </div>

                            <!-- panel-body -->
                            <hr style="margin:0;">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h5 class="panel-title">Image :</h5>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                            @if($item->image != '')
                            <img src="{{ url('uploads/pages/'.$item->image) }}" alt="page image">
                            @else
                            <img src="{{ url('images/no-image.png') }}" alt="page image">
                            @endif
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

<script>
    $('.AR').css('display','none');

    $('#AR').on('click',function(){
        $('.AR').css('display','block');
        $('.EN').css('display','none');
    });

    $('#EN').on('click',function(){
        $('.EN').css('display','block');
        $('.AR').css('display','none');
    });


</script>

@endpush
