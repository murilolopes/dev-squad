@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <div class="row">
                        <product-form :model="{{ isset($product) ? $product->toJson() : '{}' }}"></product-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection