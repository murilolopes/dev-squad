@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p style="margin-bottom: 0;">{{ $message }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    Datable
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
