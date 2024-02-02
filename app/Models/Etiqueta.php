<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etiqueta extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'color'];

    //Relacion n:m con peliculas
    public function peliculas(): BelongsToMany{
        return $this->belongsToMany(Pelicula::class);
    }
    //Accesors y muttators
    public function nombre(): Attribute{ 
        return Attribute::make(
            set: fn($v)=>strtolower($v),
            get: fn($v)=>"#".$v
        );
    }

}
