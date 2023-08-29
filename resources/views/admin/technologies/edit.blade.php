@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit of "{{ $technology->name }}"</h1>
    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old( 'name' , $technology->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-success mb-1">Confirm</button>
        <button type="reset" class="btn btn-warning mb-1">Reset Fields</button>
    </form>
    
    <form class="d-inline-block" action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this technology to the Recycle Bin?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-dark mb-1">Delete</button>
        <a class="btn btn-secondary mb-1" href="{{ route('admin.technologies.index') }}">Return to List</a>
    </form>
</div>
@endsection