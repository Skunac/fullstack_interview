<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    public function recipes(){
        return $this->hasMany(Recipes::class, 'ingredient_id');
    }
}
