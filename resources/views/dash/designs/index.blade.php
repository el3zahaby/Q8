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
                        <button class="btn btn-success" data-toggle="modal" data-target="#store"><I CLASS="mdi mdi-plus-box"></I>Add new</button>
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
                                    <td>{{ $item->name }}</td>
                                    <td><a href="{{ route('admin.users.show',$item->user->id)  }}" target="_blank">{{ $item->user->full_name }}</a> </td>
                                    <td> {{ $item->des }} </td>
                                    <td><img src="{{ $item->img }}" alt=""> </td>
                                    <td> {{ $item->price }} </td>
                                    <td> {{ $item->discount }} </td>
                                    <td> {{ $item->isAccepted(true) }} </td>

                                    <td> {{ $item->created_at->diffForHumans() }} </td>


                                    <td>
                                        <!-- delete -->
                                        <a href="{{ route('admin.designs.show',$item->id) }}"  data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>

                                        <!-- edit -->
                                        <a href="{{ route('admin.designs.edit',$item->id) }}" data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>


                                        <!-- view -->
                                        <a href="{{ route('admin.designs.show',$item->id) }}" data-id="{{ $item->id }}"  title="VIEW" class="btn btn-info"><i class="mdi mdi-eye"></i></a>
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
    <div class="modal fade " id="store" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg p-5" role="document">
            <form method="post" action="{{ route('admin.designs.store') }}"  class="modal-content form-store" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Add</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label >Name</label>
                            <input name="name" type="text" class="form-control" required >
                        </div>
                        <div class="form-group ">
                            <label>Description</label>
                            <textarea  name="des" class="form-control" autocapitalize="on"  required></textarea>
                        </div>

                        <div class="form-group ">
                            <label>Image</label>
                            <input name="img" type="file" class="form-control-file" required>
                        </div>

                        {!! Form::select('user_id', DB::table('users')->pluck('email', 'id'), null,['class' => 'form-control']) !!}

                        <div class="form-group ">
                            <label>Price</label>
                            <input name="price" type="text" class="form-control"  value="0" required>
                        </div>
                        <div class="form-group ">
                            <label>Discount</label>
                            <input name="discount" type="text" class="form-control" value="0">
                        </div>

                        <div class="form-group ">
                            <label>Accepting?</label>
                            <input name="accepting" value="1" type="checkbox" class="" >
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($items as $key=> $item)
        <!-- Modal Item {{ $item->id }} -->
        <div class="modal fade " id="edit-{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg p-5" role="document">
                <form method="post" action="{{ route('admin.designs.update',$item->id) }}" id="form-edit-{{$item->id}}" class="modal-content form-edit" enctype="multipart/form-data">
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label >Name</label>
                                <input name="name" type="text" class="form-control" required value="{{ $item->name }}">
                            </div>
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea  name="des" class="form-control" autocapitalize="on"  required>{{ $item->des }}</textarea>
                            </div>

                            <div class="form-group ">
                                <label>Image</label>
                                <input name="img" type="file" class="form-control-file my-1" >
                                <img onerror="this.src='{{ asset('images/no-image.png') }}'" src="{{  ($item->img) }}" width="90"/>

                            </div>

                            {!! Form::select('user_id', DB::table('users')->pluck('email', 'id'), null,['class' => 'form-control']) !!}

                            <div class="form-group ">
                                <label>Price</label>
                                <input name="price" type="text" class="form-control"  value="{{ $item->price ?? 0 }}" required>
                            </div>
                            <div class="form-group ">
                                <label>Discount</label>
                                <input name="discount" type="text" class="form-control"  value="{{ $item->discount ?? 0 }}">
                            </div>

                            <div class="form-group ">
                                <label>Accepting?</label>
                                <input name="accepting" value="1" type="checkbox" @if($item->isAccepted()) checked @endif class="" >

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')
    <script >
        $('.mdi-file-edit').parent().click(function (event) {
            var _this = $(this);
            event.preventDefault();

            $('#edit-'+_this.data('id')).modal('show');
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
                success: function(data) {
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
                error: function(data) {
                    if(data.status = 422){
                        var i = 0
                        $.each( data.responseJSON.errors, function( key, value ) {
                            i = i++;
                            $('[name="' + key + '"]').addClass('invalid error');
                            $('[name="' + key + '"]').after("<small class='helper-text text-danger'>"+value+"</small>")

                        });
                    }
                }
            });
        });

    </script>
@endpush
