@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Designs</h4>
                <p class="card-description">
                    <button class="btn btn-success" data-toggle="modal" data-target="#store"><I
                            CLASS="mdi mdi-plus-box"></I>Add new</button>
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th> Name</th>
                                <th> User</th>
                                <th> Description</th>
                                <th> Image</th>
                                <th> Price</th>
                                <th> Discount</th>
                                <th> Accepted</th>
                                <th> Created at</th>

                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td> {{ $item->id }} </td>
                                    <td>{{ $item->name_en }}</td>
                                    <td><a href="{{ route('admin.users.show',$item->user->id) }}"
                                            target="_blank">{{ $item->user->full_name }}</a> </td>
                                    <td> {{ $item->desc_en }} </td>
                                    <td><img src="{{ $item->img }}" alt=""> </td>
                                    <td> {{ $item->design_sizes[0]->dsize->print_price + $item->design_sizes[0]->designer_price }}
                                    </td>
                                    <td> {{ $item->discount }} </td>
                                    <td> {{ $item->isAccepted(true) }} </td>

                                    <td> {{ $item->created_at->diffForHumans() }} </td>


                                    <td>
                                        <!-- delete -->
                                        <a href="{{ route('admin.designs.show',$item->id) }}"
                                            data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i
                                                class="mdi mdi-delete"></i></a>

                                        <!-- edit -->
                                        <a href="{{ route('admin.designs.edit',$item->id) }}"
                                            data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i
                                                class="mdi mdi-file-edit"></i></a>


                                        <!-- view -->
                                        <a href="{{ route('admin.designs.show',$item->id) }}"
                                            data-id="{{ $item->id }}" title="VIEW" class="btn btn-info"><i
                                                class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Item {{ 'store' }} -->
<div class="modal fade " id="store" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg p-5" role="document">
        <form method="post" action="{{ route('admin.designs.store') }}"
            class="modal-content form-store" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Add</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="btn-group mb-3" role="group">
                    <button class="btn btn-primary EN_btn">EN</button>
                    <button class="btn btn-primary AR_btn">AR</button>
                </div>
                <div>
                    <div class="form-group EN">
                        <label>Name EN :</label>
                        <input name="name_en" type="text" class="form-control" required>
                    </div>
                    <div class="form-group AR">
                        <label>Name AR :</label>
                        <input name="name_ar" type="text" class="form-control" required>
                    </div>
                    <div class="form-group EN">
                        <label>Description EN :</label>
                        <textarea name="desc_en" class="form-control" autocapitalize="on" ></textarea>
                    </div>
                    <div class="form-group AR">
                        <label>Description AR :</label>
                        <textarea name="desc_ar" class="form-control" autocapitalize="on"></textarea>
                    </div>

                    <div class="form-group ">
                        <label>Image</label>
                        <input name="img" type="file" class="form-control-file" required>
                    </div>

                    {!! Form::select('user_id', DB::table('users')->pluck('email', 'id'), null,['class' =>
                    'form-control']) !!}



                    <div class="form-group ">
                        <label>Sizes</label>
                        <hr>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-1">choose</div>
                                <div class="col-3">size</div>
                                <div class="col-3">print price</div>
                                <div class="col-3">enter your price to add</div>
                                <div class="col-2">total</div>
                            </div>
                            <hr>

                            @foreach($sizes as $size)
                                <div class="row">
                                    <div class="col-1">
                                        <input type="checkbox" name="{{ $size->id }}" class="size_check">
                                    </div>
                                    <div class="col-3">{{ $size->width }} x {{ $size->length }}</div>
                                    <div class="col-3 print_{{ $size->id }} ">{{ $size->print_price }}</div>
                                    <div class="col-3 form-group">
                                        <input type="text" data-id="{{ $size->id }}" readonly name="price[{{ $size->id }}]" class="form-control designerPrice price_{{ $size->id }}" >
                                    </div>
                                    <div class="col-2" id="total_{{ $size->id }}">{{ $size->print_price }}</div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                    <div class="form-group ">
                        <label>Discount</label>
                        <input name="discount" type="text" class="form-control" value="0">
                    </div>

                    <div class="form-group ">
                        <label>Accepting?</label>
                        <input name="accepting" value="1" type="checkbox" class="">
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>

@foreach($items as $key=> $item)
    <!-- Modal Item {{ $item->id }} -->
    <div class="modal fade " id="edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg p-5" role="document">
            <form method="post" action="{{ route('admin.designs.update',$item->id) }}"
                id="form-edit-{{ $item->id }}" class="modal-content form-edit" enctype="multipart/form-data">
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="btn-group mb-3" role="group">
                        <button class="btn btn-primary EN_btn">EN</button>
                        <button class="btn btn-primary AR_btn">AR</button>
                    </div>
                    <div>
                        <div class="form-group EN">
                            <label>Name EN :</label>
                            <input name="name_en" type="text" class="form-control" required
                                value="{{ $item->name_en }}">
                        </div>
                        <div class="form-group AR">
                            <label>Name AR :</label>
                            <input name="name_ar" type="text" class="form-control" required
                                value="{{ $item->name_ar }}">
                        </div>
                        <div class="form-group EN">
                            <label>Description EN :</label>
                            <textarea name="desc_en" class="form-control" autocapitalize="on"
                                >{{ $item->desc_en }}</textarea>
                        </div>
                        <div class="form-group AR">
                            <label>Description AR :</label>
                            <textarea name="desc_ar" class="form-control" autocapitalize="on"
                                >{{ $item->desc_ar }}</textarea>
                        </div>

                        <div class="form-group ">
                            <label>Image</label>
                            <input name="img" type="file" class="form-control-file my-1">
                            <img onerror="this.src='{{ asset('images/no-image.png') }}'"
                                src="{{ ($item->img) }}" width="90" />

                        </div>

                        {!! Form::select('user_id', DB::table('users')->pluck('email', 'id'), null,['class'
                        =>'form-control']) !!}
                        <div class="form-group ">
                            <label>Sizes</label>
                            <hr>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-1">choose</div>
                                    <div class="col-3">size</div>
                                    <div class="col-3">print price</div>
                                    <div class="col-3">enter your price to add</div>
                                    <div class="col-2">total</div>
                                </div>
                                <hr>
                                @foreach($sizes as $size)
                                    <div class="row">
                                        <div class="col-1">
                                            <input type="checkbox" name="{{ $size->id }}" class="size_check" {{ $item->has_dsize($size->id) ? 'checked' : '' }}>
                                        </div>
                                        <div class="col-3">{{ $size->width }} x {{ $size->length }}</div>
                                        <div class="col-3 print_{{ $size->id }}{{ $item->id }}">{{ $size->print_price }}</div>
                                        <div class="col-3 form-group">
                                            <input type="text" data-id="{{ $size->id }}{{ $item->id }}"  name="price[{{ $size->id }}]" class="form-control designerPrice price_{{ $size->id }}" value="{{ $item->has_dsize($size->id) ? $item->dsize_price($size->id) : 0 }}">
                                        </div>

                                        <div class="col-2" id="total_{{ $size->id }}{{ $item->id }}">{{ $item->total($size) }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="form-group ">
                            <label>Discount</label>
                            <input name="discount" type="text" class="form-control"
                                value="{{ $item->discount ?? 0 }}">
                        </div>

                        <div class="form-group ">
                            <label>Accepting?</label>
                            <input name="accepting" value="1" type="checkbox" @if($item->isAccepted()) checked @endif
                            class="" >
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')
    <script>
        $('.mdi-file-edit').parent().click(function (event) {
            var _this = $(this);
            event.preventDefault();

            $('#edit-' + _this.data('id')).modal('show');
        });

        $('.form-edit,.form-store').submit(function (event) {
            var _this = $(this);
            event.preventDefault();
            console.log(_this);

            $.ajax({
                type: "POST",
                url: _this.attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    Swal.fire(
                        'Done!',
                        '',
                        'success'
                    ).then((result) => {
                        // Reload the Page
                        location.reload();
                    });
                },
                error: function (data) {
                    if (data.status = 422) {
                        var i = 0
                        $.each(data.responseJSON.errors, function (key, value) {
                            i = i++;
                            $('[name="' + key + '"]').addClass('invalid error');
                            $('[name="' + key + '"]').after(
                                "<small class='helper-text text-danger'>" + value +
                                "</small>")

                        });
                    }
                }
            });
        });

        $('.AR').css('display', 'none');

        $('.AR_btn ').on('click', function () {
            $('.AR').css('display', 'block');
            $('.EN').css('display', 'none');
        });

        $('.EN_btn').on('click', function () {
            $('.EN').css('display', 'block');
            $('.AR').css('display', 'none');
        });

        $('.size_check').on('change', function () {
            if ($(this).is(':checked')) {
                // console.log( "price_" + $(this).attr('name') );
                $(".price_" + $(this).attr('name')).attr('required', '');
                $(".price_" + $(this).attr('name')).removeAttr('readonly');
            } else {
                $('.price_' + $(this).attr('name')).val('');
                $(".price_" + $(this).attr('name')).removeAttr('required');
                $(".price_" + $(this).attr('name')).attr('readonly','');

            }
        });

        $('.designerPrice').on('keyup',function () {
            var $id = $(this).data('id')
            var $dp = parseFloat($(this).val());
            console.log($dp)
            if(Number.isNaN($dp)){
                $dp = 0;
            }
            var $op = $('.print_'+$id).html();
            $('#total_'+$id).html(parseFloat($op)+$dp);
        })
    </script>
@endpush
