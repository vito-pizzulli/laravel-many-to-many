<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the Technology instances.
     */
    public function index()
    {
        $technologies = Technology::paginate(14);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new Technology instance.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created Technology instance in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>"required|unique:technologies|min:3|max:255"
        ]);

        $newTechnology = new Technology;
        $data['slug'] = Str::of($data['name'])->slug('-');
        $newTechnology = Technology::create($data);
        return redirect()->route('admin.technologies.index')->with('createSuccess', 'Technology successfully added!');
    }

    /**
     * Display the specified Technology instance.
     */
    public function show()
    {
        return ('The single Technology view is disabled.');
    }

    /**
     * Show the form for editing the specified Technology instance.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified Technology instance in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'name'=>"required|unique:technologies|min:3|max:255"
        ]);

        $technology->slug = Str::of($data['name'])->slug('-');
        $technology->update($data);
        return redirect()->route('admin.technologies.index')->with('editSuccess', 'Technology successfully edited!');
    }

    /**
     * Remove the specified Technology instance from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('destroySuccess', 'Technology successfully moved to the Recycle Bin!');
    }

    /**
     * Display a listing of the trashed Technology instances.
     */
    public function trashed()
    {
        $technologies = Technology::onlyTrashed()->paginate(14);
        return view('admin.technologies.trashed', compact('technologies'));
    }

    /**
     * Restores the specified Type instance from the trashed ones.
     */
    public function restore(string $slug)
    {   
        $technology = Technology::onlyTrashed()->where('slug', $slug)->first();
        $technology->restore();
        return redirect()->route('admin.technologies.trashed')->with('restoreSuccess', 'Technology successfully restored to Types List!');
    }

    /**
     * Permanently deletes the specified Type instance from the database.
     */
    public function forceDelete(string $slug)
    {
        $technology = Technology::onlyTrashed()->where('slug', $slug)->first();
        $technology->projects()->detach();
        $technology->forceDelete();
        return redirect()->route('admin.technologies.trashed')->with('forceDeleteSuccess', 'Technology successfully deleted!');
    }
}
