<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Etiqueta;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(2)->create();
        $this->call(EtiquetaSeeder::class);
        $this->call(CategorySeeder::class);
        
        Storage::deleteDirectory('caratulas');
        Storage::makeDirectory('caratulas');
        
        $this->call(PeliculaSeeder::class);


    }
}
