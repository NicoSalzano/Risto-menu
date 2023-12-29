<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;

    protected $fillable = 
    ['name',
     'description',
     'price',
     'image',
     'status',
     'not_available',
     'featured',
     'plate_label',
     'plate_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }
}
