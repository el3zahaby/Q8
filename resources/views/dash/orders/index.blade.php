@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')



<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Orders</h4>

                <table class="table table-striped table-bordered  table-responsive">
                    <thead>
                        <th>Id</th>
                        <th>user</th>
                        <th>orders</th>
                        <th>total price</th>
                        <th>PAY Method</th>

                        <th>order_status</th>
                        <th>Change Status</th>
                        <th>Print Bill</th>
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
                                <td>{{ $item->shipping_info->pay_method ?? '!!' }}</td>

                                <td><span class="badge badge-bg" style="background: {{ $item->status->color }}">{{ $item->status->status }}</span></td>
                                <td>
                                    <form action="{{ route('admin.orders.changeStatus',$item->id) }}" method="post">
                                        @csrf
                                        <select name="status" class="ChangeStatus" data-order-id="">
                                            @foreach($status as $s)
                                                <option value="{{ $s->id }}" {{ $item->status->status == $s->status ? 'selected':'' }} >{{ $s->status }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td><a href="{{ route('admin.orders.getBill',$item->id) }}" CLASS="btn btn-info" download="true">PRINT BILL #{{$item->id}}</a></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>



@endsection @push('plugin-scripts')

@endpush

@push('custom-scripts')

    <script>
        $('.ChangeStatus').on('change',function () {
            $(this).parent().submit()
        })
    </script>
@endpush
