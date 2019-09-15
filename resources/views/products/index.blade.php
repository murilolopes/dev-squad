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
                <div class="card-header">
                    Products
                    <a class="btn btn-success" style="float: right;" href="{{ route('products.create') }}">New Product</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
