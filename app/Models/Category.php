<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['nombre'];

    //Relacion 1:N con peliculas
    public function peliculas(): HasMany{
        return $this->hasMany(Pelicula::class);
    }

    //Accesors y muttators
    public function nombre(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }
}
