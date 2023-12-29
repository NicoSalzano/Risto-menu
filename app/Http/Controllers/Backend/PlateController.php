<?php

namespace App\Http\Controllers\Backend;

use App\Models\Plate;
use App\Models\Allergen;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\PlateDataTable;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;

class PlateController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(PlateDataTable $dataTable)
    {
        return $dataTable->render('admin.Plate.index');
        // return view('admin.Plate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $allergens = Allergen::pluck('name', 'id');
        return view('admin.Plate.create',compact('allergens', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $message = [
            'name:required' => 'Il nome e richiesto',
            'name.max:50' => 'Il nome deve essere max 50 caratteri'
            // aggiungere il resto
        ];
        $request->validate([
            'name' => ['required', 'max:50'],
            'description' => ['required', 'max:2000'],
            'image'=> ['nullable', 'max:2000','image'],
            'status' => ['required'],
            'not_available' => ['required'],
            'featured' => ['required'],
            'price' => ['required'],
            'category'=> ['required'],
            'allergen'=> ['required'],
        ],$message);

        $plates = new Plate();
        $imagePath = $this->uploadImage($request,'image','uploads');
        $plates->image = $imagePath;
        $plates->name = $request->name;
        $plates->description = $request->description;
        $plates->price = $request->price;
        $plates->status = $request->status;
        $plates->not_available = $request->not_available;
        $plates->featured = $request->featured;
        $plates->category_id = $request->category;
        $plates->plate_label = $request->plate_label;
        // $plates->allergens()->attach($request->input('allergen'));
        $plates->save();

        $plate = Plate::find($plates->id);

        $plate->allergens()->sync($request->input('allergen'));

        return to_route('admin.piatti.index')->with('message', 'Success');
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
