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
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Description</label>
                                <input type="text" name="description" value="{{ $product->description }}" class="form-control" placeholder="Description">
                            </div>
                            <div class="form-group col-6">
                                <label for="price">Price</label>
                                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price">
                            </div>
                            <div class="form-group col-6">
                                <label for="category_id">Categoty:</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 text-center">
                                <button type="cancel" class="btn btn-outline-primary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
