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
                        <th>orders</th>
                        <th>total price</th>
                        <th>order_status</th>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
{{--                            @dd(dd($item->items))--}}
                            <tr>
                                <th> {{ $item->id }} </th>
                                <td> {{ $item->shipping_info->fullName.', ID:'.$item->user_id }} </td>
                                <td>
                                        <table class="mb-1  table-striped  table-bordered">
                                            <thead>
                                            <th>Design ID</th>
                                            <th>design</th>
                                            <th>tshirt</th>
                                            <th>print</th>
                                            <th>Count</th>
                                            <th>total price</th>
                                            </thead>
                                            @foreach($item->items as $cart)
                                            <tbody>

                                            <td>{{ $cart->id }}</td>
                                            <td>{{ App\Design::find($cart->id)->name }} <img src="{{ App\Design::find($cart->id)->img }}" alt=""></td>
                                            <td>
                                                <ul>
                                                    <li>Size: {!! ($cart->options->tsize['tsize']['name']) !!}</li>
                                                    <li>Color: {!! ($cart->options->tcolor['name']) !!}</li>
                                                    <li>Price: {!! ($cart->options->tsize['price']) !!}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                @if($cart->options->frontprint)
                                                    <strong>Front</strong>
                                                    <ul>
                                                        <li>Size: {!! ($cart->options->frontprint['dsize']['width'].'X'.$cart->options->frontprint['dsize']['length']) !!}</li>
                                                        <li>Designer Price: {!! ($cart->options->frontprint['designer_price']) !!}</li>
                                                        <li>Print Price: {!! ($cart->options->frontprint['dsize']['print_price']) !!}</li>
                                                        <li>Total: {!! ($cart->options->frontprint['total']) !!}</li>
                                                    </ul>
                                                @endif
                                                    @if($cart->options->backprint)
                                                        <strong>Back</strong>
                                                        <ul>
                                                            <li>Size: {!! ($cart->options->backprint['dsize']['width'].'X'.$cart->options->backprint['dsize']['length']) !!}</li>
                                                            <li>Designer Price: {!! ($cart->options->backprint['designer_price']) !!}</li>
                                                            <li>Print Price: {!! ($cart->options->backprint['dsize']['print_price']) !!}</li>
                                                            <li>Total: {!! ($cart->options->backprint['total']) !!}</li>
                                                        </ul>
                                                    @endif
                                            </td>
                                            <td>{{ ($cart->qty) }}</td>
                                            <td>{{ ($cart->price*$cart->qty) }}</td>
                                            </tbody>
                                            @endforeach
                                        </table>

                                </td>
                                <td>{{ $item->cart_total }}</td>
                                <td><span class="badge badge-bg" style="background: {{ $item->status->color }}">{{ $item->status->status }}</span></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>



{{--<!-- Modal Item {{ 'store' }} -->--}}
{{--<div class="modal fade " id="store" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg p-5" role="document">--}}
{{--        <form method="post" action="{{ route('admin.dsizes.store') }}" class="modal-content form-store">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel"><b>Add</b> </h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Length</label>--}}
{{--                        <input name="length" type="number" class="form-control" required>--}}
{{--                    </div>--}}
{{--                    <div class="form-group ">--}}
{{--                        <label>Width</label>--}}
{{--                        <input name="width" type="number" class="form-control" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group ">--}}
{{--                        <label>Print Price</label>--}}
{{--                        <input name="print_price" type="number" class="form-control" required>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@foreach($items as $key=> $item)--}}
{{--<!-- Modal Item {{ $item->id }} -->--}}
{{--<div class="modal fade " id="edit-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg p-5" role="document">--}}
{{--        <form method="PUT" action="{{ route('admin.dsizes.update',$item->id) }}" id="form-edit-{{$item->id}}" class="modal-content form-edit">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel"><b>Edit:</b> {{ $item->id }}</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Length</label>--}}
{{--                        <input name="length" type="number" class="form-control" required value="{{ $item->length }}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group ">--}}
{{--                        <label>Width</label>--}}
{{--                        <input name="width" type="number" class="form-control" value="{{ $item->width }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group ">--}}
{{--                        <label>Print Price</label>--}}
{{--                        <input name="print_price" type="number" class="form-control" value="{{ $item->print_price }}" required>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endforeach--}}



@endsection


@push('plugin-scripts')

@endpush

@push('custom-scripts')


@endpush
