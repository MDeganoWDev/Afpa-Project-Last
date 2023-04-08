<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModelRCS extends Model
{
    use HasFactory;

    protected $table = 'reglements';
    protected $fillable = ['titre', 'pdf'];

    public function getSlugAttribute()
    {
        return Str::slug($this->titre, '_');
    }
}
