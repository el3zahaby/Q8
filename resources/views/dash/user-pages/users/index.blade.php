@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <p class="card-description">
                        <button class="btn btn-success" data-toggle="modal" data-target="#store"><I CLASS="mdi mdi-plus-box"></I>Add new</button>
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th> ID</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th> age</th>
                                <th> E-mail</th>
                                <th> Phone</th>
                                <th> Address</th>
                                <th> Role</th>
                                <th> Bank Name</th>
                                <th> IBAN Bank</th>
                                <th> Name On Bank Card</th>
                                <th> Created at</th>

                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=> $item)
                                <tr>
                                    <td> {{ $item->id }} </td>
                                    <td> {{ $item->first_name }} </td>
                                    <td> {{ $item->last_name }} </td>
                                    <td> {{ (int)$item->age }} </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ $item->phone }} </td>
                                    <td> {{ $item->address }} </td>
                                    <td> {{ $item->role }} </td>
                                    <td> {{ $item->Bank_Name }} </td>
                                    <td> {{ $item->IBAN_Bank }} </td>
                                    <td> {{ $item->name_on_BankCard }} </td>

                                    <td> {{ $item->created_at->diffForHumans() }} </td>


                                    <td>
                                        <!-- delete -->
                                        <a href="{{ route('admin.users.show',$item->id) }}"  data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>

                                        <!-- edit -->
                                        <a href="{{ route('admin.users.edit',$item->id) }}" data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>


                                        <!-- view -->
                                        <a href="{{ route('admin.users.show',$item->id) }}" data-id="{{ $item->id }}"  title="VIEW" class="btn btn-info"><i class="mdi mdi-eye"></i></a>
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
            <form method="post" action="{{ route('admin.users.store') }}"  class="modal-content form-store">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->full_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label >First Name</label>
                            <input name="first_name" type="text" class="form-control" required >
                        </div>
                        <div class="form-group ">
                            <label>Last Name</label>
                            <input  name="last_name" type="text" class="form-control"  required>
                        </div>

                        <div class="form-group ">
                            <label>Age</label>
                            <input name="age" type="number" class="form-control" required>
                        </div>

                        <div class="form-group ">
                            <label>E-mail</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>

                        <div class="form-group ">
                            <label>Phone</label>
                            <input name="phone" type="text" class="form-control"   required>
                        </div>

                        <div class="form-group ">
                            <label>Bank Name</label>
                            <input name="Bank_Name" type="text" class="form-control"  >
                        </div>

                        <div class="form-group ">
                            <label>IBAN Bank</label>
                            <input name="IBAN_Bank" type="text" class="form-control"   >
                        </div>

                        <div class="form-group ">
                            <label>Name On BankCard</label>
                            <input name="name_on_BankCard" type="text" class="form-control" >
                        </div>


                        <div class="form-group ">
                            <label>Is Designer?</label>
                            <input name="is_designer" type="checkbox" class="" >
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
                <form method="PUT" action="{{ route('admin.users.update',$item->id) }}" id="form-edit-{{$item->id}}" class="modal-content form-edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->full_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="first_name" type="text" class="form-control" required value="{{ $item->first_name }}">
                            </div>
                            <div class="form-group ">
                                <label>Last Name</label>
                                <input  name="last_name" type="text" class="form-control" value="{{ $item->last_name }}" required>
                            </div>

                            <div class="form-group ">
                                <label>Age</label>
                                <input name="age" type="number" class="form-control" value="{{ $item->age }}" required>
                            </div>

                            <div class="form-group ">
                                <label>E-mail</label>
                                <input name="email" type="email" class="form-control" value="{{ $item->email }}" required>
                            </div>

                            <div class="form-group ">
                                <label>Phone</label>
                                <input name="phone" type="text" class="form-control" value="{{ $item->phone }}" required>
                            </div>

                            <div class="form-group ">
                                <label>Bank Name</label>
                                <input name="Bank_Name" type="text" class="form-control" value="{{ $item->Bank_Name }}" required>
                            </div>

                            <div class="form-group ">
                                <label>IBAN Bank</label>
                                <input name="IBAN_Bank" type="text" class="form-control" value="{{ $item->IBAN_Bank }}" required>
                            </div>

                            <div class="form-group ">
                                <label>Name On BankCard</label>
                                <input name="name_on_BankCard" type="text" class="form-control" value="{{ $item->name_on_BankCard }}" required>
                            </div>


                            <div class="form-group ">
                                <label>Is Designer?</label>
                                <input name="is_designer" type="checkbox" class=""  @if($item->isDesigner()) checked @endif>
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
                type: _this.attr('method'),
                url: _this.attr('action'),
                data: _this.serialize(),
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
