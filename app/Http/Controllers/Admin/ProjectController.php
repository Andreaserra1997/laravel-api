<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    private $validations = [
        'name'              => 'required|string|min:5|max:50',
        'client_name'       => 'required|string|min:3|max:30',
        'type_id'           => 'required|integer|exists:types,id', 
        'date'              => 'required|date', 
        'cover_image'       => 'nullable|url', 
        'image'             => 'nullable|image', 
        'summary'           => 'required|string',
        'technologies'      => 'nullable|array',
        'technologies.*'    => 'integer|exists:technologies,id',
    ];

    private $validations_messages = [
        'required'          => 'Il campo :attribute è obbligatorio',
        'min'               => 'Il campo :attribute deve contenere almeno :min caratteri',
        'max'               => 'Il campo :attribute deve contenere almeno :max caratteri',
        'url'               => 'Il campo deve essere un url valido',
        'date'              => 'Il campo :attribute deve essere in formato yyyy/mm/dd',
        'exists'            => 'Valore non valido',
    ]; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);

        $newProject = new Project();
        $newProject->name           = $data['name'];
        $newProject->slug           = Project::slugger($data['name']);
        $newProject->client_name    = $data['client_name'];
        $newProject->type_id        = $data['type_id'];
        $newProject->date           = $data['date'];
        $newProject->cover_image    = $data['cover_image'];
        $newProject->image          = $imagePath;
        $newProject->summary        = $data['summary'];
        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        if($data['image']) {
            $imagePath = Storage::put('uploads', $data['image']);

            if($project->image) {
                Storage::delete($project->image);
            }

            $project->image = $imagePath;
        }

        $project->name           = $data['name'];
        $project->client_name    = $data['client_name'];
        $project->type_id        = $data['type_id'];
        $project->date           = $data['date'];
        $project->cover_image    = $data['cover_image'];
        $project->summary        = $data['summary'];
        $project->update();

        $project->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if($project->image) {
            Storage::delete($project->image);
        }
        
        $project->technologies()->detach();

        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}
