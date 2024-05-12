@extends('layouts.base')

@section('content')
    <div class="mt-3 mb-3">
        @include('components.filter')
    </div>
    <div>
        @include('components.base-table')
    </div>
@endsection

