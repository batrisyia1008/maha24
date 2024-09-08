@extends('apps.layouts.app')

@section('title', 'Visitor')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush

@section('content')

    <h4 class="mb-4">Admin Users</h4>

    <div class="card">
        <div class="card-datatable table-responsive">

            {{ $dataTable->table() }}

        </div>
    </div>

@endsection
