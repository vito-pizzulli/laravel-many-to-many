@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Projects List</h1>
        <a class="btn btn-success mb-3" href="{{route('admin.projects.create')}}">Add New</a>
    </div>
    @if (session('createSuccess'))
        <div class="alert alert-success">
            {{ session('createSuccess') }}
        </div>
    @endif
    @if (session('destroySuccess'))
        <div class="alert alert-success">
            {{ session('destroySuccess') }}
        </div>
    @endif
    <table class="table table-light table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">GitHub Page Link</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row"> {{ $project->id }} </th>
                    <td> {{ $project->title }} </td>
                    <td> {{ $project->type->name }} </td>
                    <td> {{ $project->link }} </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.projects.show', $project) }}">View</a>
                        <a class="btn btn-sm btn-warning" href="{{route('admin.projects.edit', $project) }}">Edit</a>
                        <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this project to the Recycle Bin?')">
                            @csrf
                            @method('DELETE')
    
                            <button type="submit" class="btn btn-sm btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection