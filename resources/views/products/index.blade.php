@extends('layouts.app')

@section('content')
<div class="container" id="ca">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
    $('#ca').on('click', '.sa-remove', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.delete('/products/'+id).then(response => {
                    Swal.fire('Deleted!', 'Product has been deleted.', 'success')
                    table.draw();
                }).catch(() => Swal.fire('Error!', 'An error occurred in server. Try again!', 'error'))
            }
        })
    })
    let table = $('#table').DataTable({
        order: [0, 'desc'],
        processing: true,
        serverSide: true,
        ajax: '{{ route('products.datatable') }}',
        columns: [
        { data: 'name', name: 'name' },
        { data: 'price', name: 'price' },
        { data: 'category.name', name: 'category', searchable: false, orderable: false },
        { data: 'actions', name: 'actions', searchable: false, orderable: false },
        ]
    });
</script>
@endpush