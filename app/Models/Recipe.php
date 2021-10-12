<?php

namespace App\Models;

use App\Enums\IngredientName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        IngredientName::BUTTERSCOTCH,
        IngredientName::CINNAMON,
        'score'
    ];
}
