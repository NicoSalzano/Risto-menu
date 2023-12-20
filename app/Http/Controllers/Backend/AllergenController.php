<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AllergenDataTable;
use App\Http\Controllers\Controller;
use App\Models\Allergen;
use Illuminate\Http\Request;
use Str;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AllergenDataTable $dataTable)
    {
       return $dataTable->render('admin.Allergen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Allergen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Il nome dell allergene è richiesto',
            'name.max'=>'Il nome della categoria deve essere max 50 caratteri',
            'name.unique' => 'Questo allergene è stato già inserito',
            
        ];
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:50', 'unique:allergens,name'],
        ],$messages);

        $allergen = Allergen::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return to_route('admin.allergeni.index')->with('message','L allergene è stato inserito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $allergen = Allergen::findOrFail($id);
        return view('admin.Allergen.edit',compact('allergen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Il nome dell allergene è richiesto',
            'name.max'=>'Il nome della categoria deve essere max 50 caratteri',
            'name.unique' => 'Questo allergene è stato già inserito',
            
        ];
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:50', 'unique:allergens,name'],
        ],$messages);

        $allergen = Allergen::findOrFail($id)->update([
            'name'=> $request->name,
            'slug' => Str::slug($request->name)

        ]);
        return to_route('admin.allergeni.index')->with('message','L allergene è stato modificato.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $allergen = Allergen::findOrFail($id)->delete();
        return response(['status'=> 'success','message' => 'L allergene è stato eliminato.']);
    }
}
