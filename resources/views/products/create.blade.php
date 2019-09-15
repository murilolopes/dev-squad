@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Description">
                            </div>
                            <div class="form-group col-6">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Price">
                            </div>
                            <div class="form-group col-6">
                                <label for="category_id">Categoty:</label>
                                <select name="category_id" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
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