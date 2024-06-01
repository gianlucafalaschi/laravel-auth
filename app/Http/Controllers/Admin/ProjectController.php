<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = Project::all();  // per prendere tutti i projects utilizzo il Model (che ho importato sopra )

        //dd($projects);
        
        $data = [
            'projects' => $projects
        ];


        return view('admin.projects.index', $data);   // index si trova nella cartella projects di admin. Con view devo usare la dot.notation
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   


        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         // validazione dei dati del form prima di proseguire con il resto del codice
        $validated = $request->validate([
            'name' => 'required|unique:projects,name|min:5|max:200',   // unique vuole il nome della tabella e il nome della colonna
            'client_name' => 'required|min:5|max:250',
            'summary' => 'nullable|min:10|max:500|',
        ],
        
        [
            'name.required' => 'Add a name',
            'name.min' => 'Minimum 5 character',
            'name.max' => 'Mininum 200 characters', 
            'name.unique' => 'This name already exists', 
            'client_name.required' => 'Add a client name', 
            'client_name.min' => 'Minimum 5 characters', 
            'client_name.max' => 'Maximum 250 characters', 
            'summary.min' => 'Minimum 10 characters', 
            'summary.max' => 'Maximum 500 characters', 

        ]
        
    );

        $formData = $request->all();
        //dd($formData);
        $newProject = new Project();
        //senza fillable
        
        // $newProject->name = $formData['name'];
        // $newProject->slug = Str::slug($newProject->name , '-');
        // $newProject->client_name = $formData['client_name'];
        // $newProject->summary = $formData['summary'];
        // $newProject->save();

        // con fillable
        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->name , '-');
        $newProject->save();
        
        // messaggio flash creazione progetto
        session()->flash('success', 'Project created!'); 

        return redirect()->route('admin.projects.show', ['project' => $newProject->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) // versione con dependecy injection
    {
       

       $data = [
        'project' => $project

       ];
       
       // dd($data);

       return view('admin.projects.show', $data);
       // return view('admin.projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {   
        //dd($project);

        $data = [
            'project'=> $project
        ];
        

        return view('admin.projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {   

        // validazione dei dati del form prima di proseguire con il resto del codice
        $validated = $request->validate([
            'name' => 'required|unique:projects,name|min:5|max:200',   // unique vuole il nome della tabella e il nome della colonna
            'client_name' => 'required|min:5|max:250',
            'summary' => 'nullable|min:10|max:500|',
        ],
        
        [
            'name.required' => 'Add a name',
            'name.min' => 'Minimum 5 character',
            'name.max' => 'Mininum 200 characters', 
            'name.unique' => 'This name already exists', 
            'client_name.required' => 'Add a client name', 
            'client_name.min' => 'Minimum 5 characters', 
            'client_name.max' => 'Maximum 250 characters', 
            'summary.min' => 'Minimum 10 characters', 
            'summary.max' => 'Maximum 500 characters', 

        ]
        
    );

        $formData = $request->all();
        // dd($formData);
        
        $project->slug = Str::slug($formData['name'] , '-');
        $project->update($formData);


        // messaggio flash creazione progetto
        session()->flash('success', 'Project modified!'); 

        return redirect()->route('admin.projects.show', ['project' => $project->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->delete();
        
        
        return redirect()->route('admin.projects.index');
        //return redirect()->route('admin.projects.index');

    }
}
