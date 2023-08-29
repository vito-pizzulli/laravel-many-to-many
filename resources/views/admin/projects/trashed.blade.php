@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Projects Recycle Bin</h1>
    @if (session('restoreSuccess'))
        <div class="alert alert-success">
            {{ session('restoreSuccess') }}
        </div>
    @endif
    @if (session('forceDeleteSuccess'))
        <div class="alert alert-success">
            {{ session('forceDeleteSuccess') }}
        </div>
    @endif
    <table class="table table-dark table-hover text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Technologies</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row"> {{ $project->id }} </th>
                    <td> {{ $project->title }} </td>
                    <td>{{ $project->type->name ?? 'Empty' }}</td>
                    <td>{{ $project->technologies->isEmpty() ? 'Empty' : $project->technologies->pluck('name')->implode(', ') }}</td>
                    <td>
                        <form class="d-inline-block" action="{{ route('admin.projects.restore', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this project?')">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                        </form>
                        
                        <form class="d-inline-block" action="{{ route('admin.projects.forceDelete', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this project? This action is irreversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection