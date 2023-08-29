@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Type</h1>
    <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old( 'name') }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Confirm</button>
        <button type="reset" class="btn btn-warning">Reset Fields</button>
        <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Return to List</a>
    </form>
</div>
@endsection