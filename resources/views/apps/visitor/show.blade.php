@extends('apps.layouts.app')

@section('title', 'Visitor')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')

@endpush

@section('content')

    <h4 class="mb-4">Admin Users</h4>

    <div class="card">
        <div class="card-body">

            <a href="{{ route('visitor.index') }}" class="btn btn-warning">Back</a>

            <table class="table mt-4">
                <tbody>
                <tr>
                    <td width="20%">Zone Registered</td>
                    <td>{{ $visitor->zone->name }}</td>
                <tr>
                    <td>Register ID</td>
                    <td>{{ $visitor->uniq }}</td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>{{ $visitor->name }}</td>
                </tr>
                <tr>
                    <td>IC Number</td>
                    <td>{{ $visitor->ic_number }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $visitor->phone }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $visitor->email }}</td>
                </tr>
                <tr>
                    <td>Know Platform</td>
                    <td>{{ $visitor->know_platform }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ $visitor->total }}</td>
                </tr>
                <tr>
                    <td>QR Code</td>
                    <td><img src="{{ asset($visitor->qr_code) }}" alt="" style="height: 100px;"></td>
                </tr>
                <tr>
                    <td>Receipts</td>
                    <td>
                        @foreach($visitor->receipts as $receipt)
                            <img src="{{ asset($receipt->receipt) }}" alt="" style="width: 250px;">
                        @endforeach
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
