@component('mail::message')
    @php($i = '')
    @if($data['payment']->table == 'courses') @php($i = 'الدورة')
    @elseif($data['payment']->table == 'videos') @php($i = 'الدورة السمجلة')
    @elseif($data['payment']->table == 'package') @php($i = 'الباقة')
    @elseif($data['payment']->table == 'problems') @php($i = 'الاستشارة')
    @endif
<style>
    *:not(.text-left){text-align: right;direction: rtl}
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
# اهلا {{ ($data['user']->name) }}
لقد تم شراء {{ $i }}  بنجاح ,شكرا لك

بسعر: {{ $data['payment']->amount }} KWD

# رقم عملية الشراء : #{{ $data['payment']->trans_id }}

@if($data['payment']->table == 'problems')
@component('mail::table')
| الاسم | الوصف | الصورة | تاريخ الشراء |
|------|:----:|:---:|:----:|
@foreach($data['payment']->items as $pay)
| {{ $data['payment']->item($pay)->consulting()->name }} | {{ $data['payment']->item($pay)->consulting()->desc }} | <img src="{{ $data['payment']->item($pay)->consulting()->img }}"> | {{ $data['payment']->created_at }} |
@endforeach
@endcomponent
@else
@component('mail::table')
| الاسم | الوصف | الصورة | تاريخ الشراء |
|------|:----:|:---:|:----:|
@foreach($data['payment']->items as $pay)
| {{ $data['payment']->item($pay)->name }} | {{ $data['payment']->item($pay)->desc }} | <img src="{{ $data['payment']->item($pay)->img }}"> | {{ $data['payment']->created_at }} |
@endforeach
@endcomponent
@endif

@if($data['payment']->table == 'problems')
<br>
المشكلة:<br>
<b class="card card-body">
{{--    @dd($data['payment']->item($data['payment']->items_id))--}}
{{--    {{ $pay->item($pay->id)->problem }}--}}
    {{ $data['payment']->item($data['payment']->items_id)->problem }}
</b>
@endif
{{--<table>--}}
{{--    <thead>--}}
{{--    <table style="width: 100%;" >--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td><b>الاسم</b></td>--}}
{{--            <td><b>الوصف</b></td>--}}
{{--            <td><b>صورة</b></td>--}}
{{--            <td><b>تاريخ الشراء</b></td>--}}
{{--        </tr>--}}
{{--        @php($payment = \App\Payment::find($data['payment']->id))--}}
{{--        @dd($data['payment'])--}}
{{--        @forelse($data['payment']->items as $pay)--}}
{{--        <tr>--}}
{{--            <td>{{ $data['payment']->item($pay)->name }}</td>--}}
{{--            <td>{{ $data['payment']->item($pay)->desc }}</td>--}}
{{--            <td><img src="{{ $data['payment']->item($pay)->img }}"></td>--}}
{{--            <td>{{ $data['payment']->created_at }}</td>--}}
{{--        </tr>--}}
{{--        @empty--}}
{{--        @endforelse--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    </thead>--}}
{{--</table>--}}


Thanks,{{ setting('app_name') }}
@endcomponent

