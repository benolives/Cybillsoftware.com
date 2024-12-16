@extends('layouts.admin_layout')

@section('content')
    <div>
        <div class="alert alert-danger">
            <i class="fa fa-times-circle"></i> {{ session('message') }}
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Error Details</h4>
            </div>
            <div class="card-body">
                <p>{{ session('details') }}</p>
                <p>If you need further assistance, please <a href="mailto:support@yourdomain.com">contact our support team</a>.</p>
            </div>
        </div>
    </div>
@endsection