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
                <div class="card-header">Import CSV</div>
                <div class="card-body">
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="csv">File:</label>
                                <input type="file" id="csv" name="csv" accept=".csv">
                            </div>
                            <div class="form-group col-12 text-center">
                                <button type="reset" class="btn btn-outline-primary">Cancel</button>
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
