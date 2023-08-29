<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the Type instances.
     */
    public function index()
    {
        $types = Type::paginate(14);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new Type instance.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created Type instance in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>"required|unique:types|min:3|max:255"
        ]);

        $newType = new Type;
        $data['slug'] = Str::of($data['name'])->slug('-');
        $newType = Type::create($data);
        return redirect()->route('admin.types.index')->with('createSuccess', 'Type successfully added!');
    }

    /**
     * Display the specified Type instance.
     */
    public function show()
    {
        return ('The single Type view is disabled.');
    }

    /**
     * Show the form for editing the specified Type instance.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified Type instance in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'name'=>"required|unique:types|min:3|max:255"
        ]);

        $type->slug = Str::of($data['name'])->slug('-');
        $type->update($data);
        return redirect()->route('admin.types.index')->with('editSuccess', 'Type successfully edited!');
    }

    /**
     * Remove the specified Type instance from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('destroySuccess', 'Type successfully moved to the Recycle Bin!');
    }

    /**
     * Display a listing of the trashed Type instances.
     */
    public function trashed()
    {
        $types = Type::onlyTrashed()->paginate(14);
        return view('admin.types.trashed', compact('types'));
    }

    /**
     * Restores the specified Type instance from the trashed ones.
     */
    public function restore(string $slug)
    {   
        $type = Type::onlyTrashed()->where('slug', $slug)->first();
        $type->restore();
        return redirect()->route('admin.types.trashed')->with('restoreSuccess', 'Type successfully restored to Types List!');
    }

    /**
     * Permanently deletes the specified Type instance from the database.
     */
    public function forceDelete(string $slug)
    {
        $type = Type::onlyTrashed()->where('slug', $slug)->first();
        $type->forceDelete();
        return redirect()->route('admin.types.trashed')->with('forceDeleteSuccess', 'Type successfully deleted!');
    }
}
