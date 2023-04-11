<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibilite extends Model
{
    use HasFactory;

    public function modelNDS()
    {
        return $this->hasMany(ModelNDS::class);
    }
    public function modelRCS()
    {
        return $this->hasMany(ModelRCS::class);
    }
}
