@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product Details</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $product->name }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                {{ $product->description }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Price:</strong>
                                {{ $product->price }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Category:</strong>
                                {{ $product->category->name }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <strong>Photo:</strong>
                                <img src="{{ count($product->media) ? $product->media[0]->getUrl() : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
