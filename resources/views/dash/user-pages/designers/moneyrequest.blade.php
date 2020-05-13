@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')

<!-- {{ print("<pre>".print_r($items , true)."</pre>") }} -->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Designers Money Requests</h4>
                

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th>Designer Name</th>
                                <th>Designer Mail</th>
                                <th>Amount</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=> $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->first_name . " " . $item->last_name }} </td>
                                <td> {{ $item->email }} </td>
                                <td> {{ $item->designerMoney($item->id) }} </td>

                                <td>
                                    <!-- delete -->
                                    <a href="{{ route('admin.users.show',$item->id) }}" data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>

                                    <!-- edit -->
                                    <a href="{{ route('admin.users.edit',$item->id) }}" data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>


                                    <!-- view -->
                                    <a href="{{ route('admin.users.show',$item->id) }}" data-id="{{ $item->id }}" title="VIEW" class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                    @if (!$item->hasVerifiedEmail())
                                    <a href="{{ route('admin.users.verify',$item->id) }}" data-id="{{ $item->id }}" title="Verify" class="btn btn-primary"><i class="mdi mdi-hand-okay"></i></a>
                                    @endif
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


@foreach($items as $key=> $item)
        <!-- Modal Item {{ $item->id }} -->
        <div class="modal fade " id="edit-{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg p-5" role="document">
                <form method="post" action="{{ route('admin.users.moneyrequest',$item->id) }}" id="form-edit-{{$item->id}}" class="modal-content form-edit" enctype="multipart/form-data">
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->full_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h1>Was the money transferred to this designer?</h1>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No , Close</button>
                        <button type="submit"  class="btn btn-primary">Yes</button>
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

        $('.ChangeStatus').on('change',function(){
            $(this).parent().submit();
        });


    </script>
@endpush

