<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bill #{{$id}}</title>
    <link rel="stylesheet" href="css/reports/bill.css">
    <style>
        @page {
            max-width: 100%;
        }

        #shipping {
            float: right;
            text-align: left;
        }

        td, th {
            text-align: left !important;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <h1>Bill #{{$id}}</h1>
    <div id="company" class="clearfix">
        <div>QB-Shirt</div>
    </div>
    <div id="project">
        <div><span>CLIENT</span> {{$order->user->first_name.' '.$order->user->last_name}}</div>
        <div><span>ADDRESS</span> {{$order->user->address}}</div>
        <div><span>EMAIL</span> <a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a></div>
        <div><span>DUE DATE</span> {{$order->created_at}}</div>
        <hr>
        <div><span>STATUS</span> {{$order->status->status}}</div>
        <div><span>DATE</span> {{now()}}</div>
    </div>
    <div id="shipping">
        @php
            $shippingInfo = json_decode($order->shipping_info,true)
        @endphp
        <div><span>Full Name</span> {{$shippingInfo['fullName']}}</div>
        <div><span>Address</span> {{$shippingInfo['address']}}</div>
        <div><span>Email</span> {{$shippingInfo['email']}}</div>
        <div><span>Phone</span> {{$shippingInfo['phone']}}</div>
        {{--        <div><span>Phone Number</span> {{$shippingInfo}}</div>--}}

    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Random ID</th>
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $cartItem)
            <tr>
                <td>{{$cartItem->id}}</td>
                <td>{{$cartItem->options->random_name}}</td>
                <td class="desc">
                    <ul>
                        <li>Name : {{$cartItem->name}}</li>
                        <li>Size : {{\App\Tsize::getSizeStrById($cartItem->options->tsize)}}</li>
                        <li>Front : {{\App\Dsize::getStrById($cartItem->options->frontprint)}}</li>
                        <li>Back : {{\App\Dsize::getStrById($cartItem->options->backprint)}}</li>
                        <li>Color : {{\App\Color::getNameById($cartItem->options->tcolor)}}</li>
                    </ul>
                </td>
                <td>{{$cartItem->price}}</td>
                <td>{{$cartItem->qty}}</td>
                <td>{{$cartItem->total()}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{$total['total']}}</td>
        </tr>
        </tbody>
    </table>
</main>
</body>
</html>
