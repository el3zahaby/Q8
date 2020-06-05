@extends('layouts.dash')

@push('plugin-styles')
    <style>
        .content-wrapper {
            background: #f3f4fa;
            padding: 0 !important;
            width: 100%;
            flex-grow: 1;
        }
    </style>
@endpush

@section('content')
    <iframe src="{{ route('unisharp.lfm.show') }}" width="100%" style="height: 100%;" class="border-0"></iframe>
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush
