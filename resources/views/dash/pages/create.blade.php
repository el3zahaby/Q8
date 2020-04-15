@extends('layouts.dash')

@push('plugin-styles')
    <style>
        .panel-heading {
            margin-top: 20px;
        }

    </style>
    <script src="{{ url('dash/js/ckeditor-5.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Color View</h4>
                {{-- <p class="card-description"> View <code>{{ $item->full_name }}</code>
                --}}
                <a class="btn btn-success" href="{{ route('admin.pages.index') }}"><I
                        CLASS="mdi mdi-page-previous"></I>BACK</a>
                </p>
                <div class="col-md-12">

                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <form action="{{ route('admin.pages.store') }}" method="post">
                        @csrf
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
                            <textarea name="" id="editor" style="height: 200px;"></textarea>
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
                        <div class="form-group">
                            <label>Page Image</label>
                            <input type="file" name="image" class="form-control p-2">
                        </div>

                    </form>
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
    ClassicEditor
        .create( document.querySelector( '#editor' ) , {
            initialData : '<h1>Add Your Page Content Here ... </h1>'
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

@endpush
