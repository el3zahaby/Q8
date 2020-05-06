@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')



<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Orders</h4>

                <table class="table table-striped table-bordered ">
                    <thead>
                        <th>Id</th>
                        <th>user</th>
                        <th>design</th>
                        <th>tshirt</th>
                        <th>print</th>
                        <th>total price</th>
                        <th>order_status</th>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th> {{ $item->id }} </th>
                                <td> {{ $item->order_infos->shipping_info->email }} </td>
                                <td> <img src="{{ $item->order_infos->design->img }}" alt=""> </td>
                                <td>
                                    <strong>TShirt</strong>
                                    <ul>
                                        <li>ID: {{ $item->order_infos->tshirt->id }}</li>
                                        <li>Size: {{ $item->order_infos->tshirt->size }}</li>
                                        <li>Color: {{ $item->order_infos->tshirt->color->name }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <strong>Front</strong>
                                    <ul>
                                        <li>Size: {{ $item->order_infos->print->front->size }}</li>
                                        <li>PrintPrice: {{ $item->order_infos->print->front->print_price }}</li>
                                    </ul>

                                    <strong>Back</strong>
                                    <ul>
                                        <li>Size: {{ $item->order_infos->print->back->size }}</li>
                                        <li>PrintPrice: {{ $item->order_infos->print->back->print_price }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->order_infos->total }}</td>
                                <td><span class="badge badge-bg" style="background: {{ ($item->status->color) }};zoom: 1.3;">{{ ($item->status->status) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>



<!-- Modal Item {{ 'store' }} -->
<div class="modal fade " id="store" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg p-5" role="document">
        <form method="post" action="{{ route('admin.dsizes.store') }}" class="modal-content form-store">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Add</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="form-group">
                        <label>Length</label>
                        <input name="length" type="number" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <label>Width</label>
                        <input name="width" type="number" class="form-control" required>
                    </div>

                    <div class="form-group ">
                        <label>Print Price</label>
                        <input name="print_price" type="number" class="form-control" required>
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
<div class="modal fade " id="edit-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg p-5" role="document">
        <form method="PUT" action="{{ route('admin.dsizes.update',$item->id) }}" id="form-edit-{{$item->id}}" class="modal-content form-edit">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="form-group">
                        <label>Length</label>
                        <input name="length" type="number" class="form-control" required value="{{ $item->length }}">
                    </div>
                    <div class="form-group ">
                        <label>Width</label>
                        <input name="width" type="number" class="form-control" value="{{ $item->width }}" required>
                    </div>

                    <div class="form-group ">
                        <label>Print Price</label>
                        <input name="print_price" type="number" class="form-control" value="{{ $item->print_price }}" required>
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


@endpush
