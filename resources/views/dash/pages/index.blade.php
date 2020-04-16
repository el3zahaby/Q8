@extends('layouts.dash')

@push('plugin-styles')
    {{-- <script src="{{ url('dash/js/ckeditor-5.js') }}"></script> --}}

    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Statuses</h4>
                <p class="card-description">
                    <button class="btn btn-success" data-toggle="modal" data-target="#store"><I
                            CLASS="mdi mdi-plus-box"></I>Add new</button>
                    {{-- <a href="{{ route('admin.pages.create') }}" class="btn
                    btn-success"><I CLASS="mdi mdi-plus-box"></I>Add new</a> --}}
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th> Title</th>
                                <th> Status</th>
                                <th> Image</th>
                                <th> Created at</th>

                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($table as $key=> $item)
                                <tr>
                                    <td> {{ $item->id }} </td>
                                    <td> {{ $item->title }} </td>
                                    <td> {{ $item->status }} </td>
                                    <td> {{ $item->image }} </td>

                                    <td> {{ $item->created_at->diffForHumans() }} </td>


                                    <td>
                                        <!-- delete -->
                                        <a href="{{ route('admin.pages.show',$item->id) }}"
                                            data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i
                                                class="mdi mdi-delete"></i></a>

                                        <!-- edit -->
                                        <a href="{{ route('admin.pages.edit',$item->id) }}"
                                            data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i
                                                class="mdi mdi-file-edit"></i></a>


                                        <!-- view -->
                                        <a href="{{ route('admin.pages.show',$item->id) }}"
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
        <form method="post" action="{{ route('admin.pages.store') }}"
            class="modal-content form-store" enctype="multipart/form-data" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Add:</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="btn-group my-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" id="EN">EN</button>
                        <button type="button" class="btn btn-primary" id="AR">AR</button>
                    </div>

                    <div class="form-group EN">
                        <label>Title EN: </label>
                        <input type="text" name="title_en" id="" class="form-control">
                    </div>
                    <div class="form-group AR">
                        <label>Title AR: </label>
                        <input type="text" name="title_ar" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Excerpt : </label>
                        <textarea name="excerpt" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group EN">
                        <label>Body EN :</label>
                        <textarea name="body_en" id="ed-1" class="editor" style="height: 200px;"></textarea>
                    </div>
                    <div class="form-group AR">
                        <label>Body AR :</label>
                        <textarea name="body_ar" id=ed-2 class="editor" style="height: 200px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <input type="text" name="meta_desc" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control p-0">
                            <option value="INACTIVE">INACTIVE</option>
                            <option value="ACTIVE">ACTIVE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Page Image</label>
                        <input type="file" name="image" class="form-control p-2">
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
            <form method="PUT" action="{{ route('admin.pages.update',$item->id) }}"
                id="form-edit-{{ $item->id }}" class="modal-content form-edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label>Title EN: </label>
                            <input type="text" name="title_en" id="" class="form-control EN">
                        </div>
                        <div class="form-group">
                            <label>Title AR: </label>
                            <input type="text" name="title_ar" id="" class="form-control AR">
                        </div>
                        <div class="form-group">
                            <label>Excerpt : </label>
                            <textarea name="excerpt" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Body EN :</label>
                            <textarea name="body_en" id="editor_edit_en" style="height: 200px;" class="EN"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Body AR :</label>
                            <textarea name="body_ar" id="editor_edit_ar" style="height: 200px;" class="AR"></textarea>
                        </div>
                        <div class="form-group">
                            <label>slug</label>
                            <input type="text" name="slug" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input type="text" name="meta_desc" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control p-0">
                                <option value="0">INACTIVE</option>
                                <option value="1">ACTIVE</option>
                            </select>
                        </div>
                        <input type="text" name="textfile" id="">
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

{{-- {{ print_r($items) }} --}}
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

            let data =  new FormData( this );
            console.log(data);
            /*

            $.ajax({
                type: _this.attr('method'),
                url: _this.attr('action'),
                data: new FormData( this ),
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

            */
        });

        // ClassicEditor
        //     .create(document.querySelector('.ed-1'), {
        //         initialData: '<h1>Add Your Page Content Here ... </h1>'
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });




            $('.editor').each(function () {
                CKEDITOR.replace($(this).attr('id'), {
                    filebrowserImageBrowseUrl: '/filemanager?type=Images',
                    filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/filemanager?type=Files',
                    filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{csrf_token()}}',

                });
            });

        
        
        
        
        
        
        
        $('.AR').css('display', 'none');

        $('#AR').on('click', function () {
            $('.AR').css('display', 'block');
            $('.EN').css('display', 'none');
        });

        $('#EN').on('click', function () {
            $('.AR').css('display', 'none');
            $('.EN').css('display', 'block');
        });

    </script>

@endpush