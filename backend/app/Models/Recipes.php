<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $fillable = [
        'title',
        'description',
        'instructions',
        'ingredients',
        'prep_time',
        'cook_time',
        'total_time',
        'servings',
        'calories',
    ];
    public $timestamps = true;  

}
