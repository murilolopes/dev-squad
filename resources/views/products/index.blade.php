@extends('layouts.app')

@section('content')
<div class="container" id="ca">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('pageLevelScripts')
<script>
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('products.datatable') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                { data: 'category.name', name: 'category' },
                { data: 'actions', name: 'actions' },
            ]
        });
</script>
@endpush