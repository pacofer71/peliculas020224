<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags=[
            'infantil'=>'#03a9f4',
            'accion'=>'#e040fb',
            'aventura'=>'#ffeb3b',
            'animada'=>'#BDBDBD',
            'batallas'=>'#ff9800',
            'laravel'=>'#cddc39'
        ];
        foreach($tags as $nombre=>$color){
            Etiqueta::create(compact('nombre', 'color'));
        }
    }
}
