@extends('layouts.app')

@section('content')
<store-component></store-component>
@endsection

@section('script')
    <script src="{{ asset('js/store.js') }}" defer></script>
@endsection
