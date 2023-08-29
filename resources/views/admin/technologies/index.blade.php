@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Technologies List</h1>
        <div class="mb-3">
            <a class="btn btn-success" href="{{route('admin.technologies.create')}}">Add New</a>
            <a class="btn btn-dark" href="{{ route('admin.technologies.trashed') }}">Recycle Bin</a>
        </div>
    </div>
    @if (session('createSuccess'))
        <div class="alert alert-success">
            {{ session('createSuccess') }}
        </div>
    @endif
    @if (session('editSuccess'))
        <div class="alert alert-success">
            {{ session('editSuccess') }}
        </div>
    @endif
    @if (session('destroySuccess'))
        <div class="alert alert-success">
            {{ session('destroySuccess') }}
        </div>
    @endif
    <table class="table table-info table-hover text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <th scope="row"> {{ $technology->id }} </th>
                    <td> {{ $technology->name }} </td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{route('admin.technologies.edit', $technology) }}">Edit</a>
                        <form class="d-inline-block" action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this technology to the Recycle Bin?')">
                            @csrf
                            @method('DELETE')
    
                            <button type="submit" class="btn btn-sm btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $technologies->links() }}
</div>
@endsection