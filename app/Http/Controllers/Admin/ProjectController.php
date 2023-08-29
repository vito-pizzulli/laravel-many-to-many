<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Technology;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the Project instances.
     */
    public function index()
    {
        $projects = Project::paginate(14);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new Project instance.
     */
    public function create()
    {   
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created Project instance in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>"required|unique:projects|min:3|max:255",
            'type_id' => 'required|exists:types,id',
            'technologies' => ['exists:technologies,id'],
            'description'=>"required|min:3",
            'link'=>"url:https",
            'creation_date'=>"required|date",
            'image'=>"required|image"
        ]);

        $img_path = Storage::put('uploads/projects', $request['image']);
        $data['image'] = $img_path;
        $data['slug'] = Str::of($data['title'])->slug('-');
        $newProject = Project::create($data);
        $newProject->slug = Str::of("$newProject->id " . $data['title'])->slug('-');
        $newProject->save();
        $newProject->technologies()->sync( $request->technologies);
        return redirect()->route('admin.projects.index')->with('createSuccess', 'Project successfully added!');
    }

    /**
     * Display the specified Project instance.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified Project instance.
     */
    public function edit(Project $project)
    {   
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified Project instance in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            "title" => ["required", "min:3", "max:255", Rule::unique('projects')->ignore($project->id)],
            'type_id' => 'required|exists:types,id',
            'technologies' => ['exists:technologies,id'],
            'description'=>"required|min:3",
            'link'=>"url:https",
            'creation_date'=>"required|date",
            'image'=>"required|image"
        ]);

        Storage::delete($project->image);
        $img_path = Storage::put('uploads/projects', $request['image']);
        $data['image'] = $img_path;
        $project->slug = Str::of("$project->id " . $data['title'])->slug('-');
        $project->update($data);
        $project->technologies()->sync( $request->technologies);
        return redirect()->route('admin.projects.show', compact('project'))->with('editSuccess', 'Project successfully edited!');
    }

    /**
     * Remove the specified Project instance from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('destroySuccess', 'Project successfully moved to the Recycle Bin!');
    }

    /**
     * Display a listing of the trashed Project instances.
     */
    public function trashed()
    {
        $projects = Project::onlyTrashed()->paginate(14);
        return view('admin.projects.trashed', compact('projects'));
    }

    /**
     * Restores the specified Project instance from the trashed ones.
     */
    public function restore(string $slug)
    {
        $project = Project::onlyTrashed()->findOrFail($slug);
        $project->restore();
        return redirect()->route('admin.projects.trashed')->with('restoreSuccess', 'Project successfully restored to Projects List!');
    }

    /**
     * Permanently deletes the specified Project instance from the database.
     */
    public function forceDelete(string $slug)
    {
        $project = Project::onlyTrashed()->findOrFail($slug);
        Storage::delete($project->image);
        $project->technologies()->detach();
        $project->forceDelete();
        return redirect()->route('admin.projects.trashed')->with('forceDeleteSuccess', 'Project successfully deleted!');
    }
}
