@extends('layouts.app', [
    'title' => __('Dashboard'),
    'activeFolder' => 'dashboard',
    'activePage' => '',
])


@section('content')
    @include('layouts.headers.cards')
    
    <div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush