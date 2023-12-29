<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];
    // public function plates() {
    //     return $this->belongsToMany(Plate::class);
    // }
}
