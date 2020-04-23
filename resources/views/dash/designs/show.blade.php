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
                <h4 class="card-title">Design</h4>
                <p class="card-description"> View <code>{{ $item->name }}</code>
                    <a class="btn btn-success" href="{{ route('admin.designs.index') }}"><I
                            CLASS="mdi mdi-page-previous"></I>BACK</a>
                </p>
                <div class="col-md-12">

                    <div class="btn-group" role="group">
                        <button class="btn btn-primary EN_btn">EN</button>
                        <button class="btn btn-primary AR_btn">AR</button>
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
                            <h5 class="panel-title">Name EN :</h5>
                        </div>

                        <div class="panel-body EN" style="padding-top:0;">
                            <p>{{ $item->name_en }}</p>
                        </div>


                        <!-- panel-body -->
                        <hr style="margin:0;">
                        <div class="panel-heading AR" style="border-bottom:0;">
                            <h5 class="panel-title">Name AR :</h5>
                        </div>

                        <div class="panel-body AR" style="padding-top:0;">
                            <p>{{ $item->name_ar }}</p>
                        </div>



                        <!-- panel-body -->
                        <hr style="margin:0;">
                        <div class="panel-heading EN" style="border-bottom:0;">
                            <h5 class="panel-title">Description EN :</h5>
                        </div>

                        <div class="panel-body EN" style="padding-top:0;">
                            <textarea class="p-3 w-100 border" dir="auto" readonly>{!! $item->desc_en !!}</textarea>
                        </div>


                        <!-- panel-body -->
                        <hr style="margin:0;">
                        <div class="panel-heading AR" style="border-bottom:0;">
                            <h5 class="panel-title">Description AR :</h5>
                        </div>

                        <div class="panel-body AR" style="padding-top:0;">
                            <textarea class="p-3 w-100 border" dir="auto" readonly>{!! $item->desc_ar !!}</textarea>
                        </div>


                        <!-- panel-body -->
                        <hr style="margin:0;">
                        <div class="panel-heading" style="border-bottom:0;">
                            <h5 class="panel-title">Image</h5>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            <p><img onerror="this.src='{{ asset('images/no-image.png') }}'"
                                    src="{{ ($item->img) }}" class="m-auto d-block border" width="500" /></p>
                        </div>

                        <!-- panel-body -->
                        <hr style="margin:0;">
                        <div class="panel-heading" style="border-bottom:0;">
                            <h5 class="panel-title">Sizes :</h5>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            <table class="table">
                                <thead>
                                    <th>size :</th>
                                    <th>print price :</th>
                                    <th>designer price :</th>
                                    <th>total :</th>
                                </thead>
                                <tbody>
                                    @foreach($item->design_sizes as $ds)
                                        <tr>
                                            <td>{{ $ds->dsize->width }} x {{ $ds->dsize->length }}</td>
                                            <td>{{ $ds->dsize->print_price }}</td>
                                            <td>{{ $ds->designer_price }}</td>
                                            <td> {{ $ds->designer_price + $ds->dsize->print_price }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

    <script>
        $('.AR').css('display', 'none');

        $('.AR_btn ').on('click', function () {
            $('.AR').css('display', 'block');
            $('.EN').css('display', 'none');
        });

        $('.EN_btn').on('click', function () {
            $('.EN').css('display', 'block');
            $('.AR').css('display', 'none');
        });

    </script>


@endpush
