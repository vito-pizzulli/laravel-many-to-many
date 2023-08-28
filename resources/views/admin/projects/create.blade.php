@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Project</h1>
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old( 'title') }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="type_id" class="form-label">Type:</label>
            <select name="type_id" id="type_id" class="form-select">
                <option selected hidden></option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies:</label>
            <div>
                @foreach ($technologies as $technology)
                    <input type="checkbox" name="technologies[]" class="form-check-input" id="technologies" value="{{ $technology->id }}"
                        @if( in_array($technology->id, old('technologies', []))) checked @endif>
                    <label for="technologies" class="form-check-label me-3">{{ $technology->name }}</label>
                @endforeach
            </div>
        </div>
        @error('technologies')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old( 'description') }}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="link" class="form-label">GitHub Page Link:</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ old( 'link') }}">
        </div>
        @error('link')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="creation_date" class="form-label">Date Of Creation:</label>
            <input type="date" class="form-control" id="creation_date" name="creation_date" value="{{ old( 'creation_date') }}">
        </div>
        @error('creation_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
            <div id="imageHelp" class="form-text">Upload a preview image for your project.</div>
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-success">Confirm</button>
        <button type="reset" class="btn btn-warning">Reset Fields</button>
        <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">Return to List</a>
    </form>
</div>
@endsection