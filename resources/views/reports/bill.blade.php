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

    <img width="90" src="{{ public_path(str_replace(url('/'),'',setting('app_logo'))) }}">
    <h1>Bill #{{$id}}</h1>
    <div id="company" class="clearfix">
        <div>Q8-Shirt</div>
    </div>
    <div id="project">
        <div><span>CLIENT</span> {{$order->user->first_name.' '.$order->user->last_name}}</div>
        <div><span>ADDRESS</span> {{$order->user->address}}</div>

        <div><span>EMAIL</span> <a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a></div>
        <div><span>DUE DATE</span> {{$order->created_at}}</div>
        <hr>
        <div><span>STATUS</span> {{$order->status->status}}</div>
        <div><span>DATE</span> {{$order->crated_at}}</div>
    </div>
    <div id="shipping">
        @php
            $shippingInfo = $order->shipping_info
        @endphp
        <div><span>Full Name</span> {{$shippingInfo->fullName}}</div>
        <div><span>Address</span> {{$shippingInfo->address}}</div>
        <div><span>Email</span> {{$shippingInfo->email}}</div>
        <div><span>Phone</span> {{$shippingInfo->phone}}</div>
        @php $link= "https://www.google.com/maps/@".str_replace(', ',',',str_replace(['lat: ','lng: '],'',$order->user->address)).",17z" @endphp
        <div><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$link}}&chld=L|1&choe=UTF-8" alt=""></div>
    </div>
</header>
<main>
    <table width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Design</th>
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
                <td><img width="90" src="{{public_path($cartItem->options['product']['design']['thump'])}}" alt=""></td>
                <td class="desc">
                    <ul>
                        <li>Name : {{$cartItem->name_en}}</li>
                        <li>Size : {{ $cartItem->options['tsize']['tsize']['name'] }} </li>
                        <li>Front : {{($cartItem->options->frontprint? $cartItem->options->frontprint['dsize']['length'].' X '.$cartItem->options->frontprint['dsize']['width'] :'')}}</li>
                        <li>Back : {{($cartItem->options->backprint? $cartItem->options->backprint['dsize']['length'].' X '.$cartItem->options->backprint['dsize']['width'] :'')}}</li>
                        <li>Color : {{($cartItem->options['tcolor']['name'])}}</li>
                    </ul>
                </td>
                <td>{{$cartItem->price}}<small> KWD</small></td>
                <td>{{$cartItem->qty}}</td>
                <td>{{$cartItem->total()}}<small> KWD</small></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{$total['total']}} <small> KWD</small></td>
        </tr>
        </tbody>
    </table>
</main>
</body>
</html>
