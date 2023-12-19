<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.Category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Il nome della categoria è richiesto',
            'name.max'=>'Il nome della categoria deve essere max 50 caratteri',
            'name.unique' => 'Questa categoria è stata già creata',
            'status.required' => 'Il campo status è richiesto',
        ];
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:50', 'unique:categories,name'],
            'status'=> 'required'
        ],$messages);

        $categories = Category::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('admin.category.index'))->with('message','La categoria è stata creata.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
