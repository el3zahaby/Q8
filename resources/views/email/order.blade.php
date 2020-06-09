@component('mail::message')
    @php($i = 'التصميم')

<style>
    @if(isset($_COOKIE['locale']))
        @if($_COOKIE['locale'] =='ar' or $_COOKIE['locale'] =='AR')
            *:not(.text-left){text-align: right;direction: rtl}
        @endif
    @endif
</style>
<style>
table {
border-collapse: collapse;
border-spacing: 0;
width: 100% !important;
/*border: 1px solid #ddd;*/
}
div{
overflow-x: auto!important;
max-width: 100%;
}
</style>
# اهلا عزيزنا {{ ($data['user']->first_name) }}
لقد تم شراء {{ $i }}  بنجاح ,شكرا لك

بسعر: {{ ($data['payment']->cart_total) }} KWD

# رقم عملية الشراء : #{{ $data['payment']->id }}


@component('mail::table')
| الاسم | الوصف | الصورة | تاريخ الشراء |
|------|:----:|:---:|:----:|
@foreach($data['payment']->items as $pay)
| {{ $pay->name }} | {{ $pay->options['product']['design']['desc'] }} | <img src="{{ url($pay->options['product']['design']['img']) }}"> | {{ $data['payment']->created_at }} |
@endforeach
@endcomponent



Thanks,{{ setting('app_name') }}
@endcomponent

