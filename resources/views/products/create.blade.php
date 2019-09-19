@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <div class="row">
                        <product-form></product-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection