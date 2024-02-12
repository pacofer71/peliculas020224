<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Etiqueta;
use App\Models\Pelicula;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPeli extends Component
{
    use WithFileUploads;

    public bool $openModalCrear=false;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;
    
    #[Validate(['required', 'string', 'min:3', 'unique:peliculas,titulo'])]
    public string $titulo;

    #[Validate(['required', 'string', 'min:10'])]
    public string $sinopsis;

    #[Validate(['nullable'])]
    public ?string $disponible=null;

    #[Validate(['required', 'exists:categories,id'])]
    public string $category_id;

    #[Validate(['required', 'array', 'min:1', 'exists:etiquetas,id'])]
    public array $etiquetas_id=[];



    public function render()
    {
        $etiquetas=Etiqueta::select("id", "nombre", "color")->orderBy('nombre')->get();
        $categorias=Category::select("id", "nombre")->orderBy('nombre')->get();

        return view('livewire.crear-peli', compact('etiquetas', 'categorias'));
    }

    public function store(){
        $this->validate();
        $pelicula=Pelicula::create([
            'titulo'=>$this->titulo,
            'sinopsis'=>$this->sinopsis,
            'category_id'=>$this->category_id,
            'disponible'=>($this->disponible) ? "SI" : "NO",
            'caratula' =>($this->imagen) ? $this->imagen->store('caratulas') : "noimage.png",
        ]);

        //le añado a la pelicula recien creada sus etiquetas
        $pelicula->etiquetas()->attach($this->etiquetas_id);

        //Avisamos al show-peliculas para que se actualiza y aparezca la pelicula creda
        $this->dispatch('evento_pelicula_creada')->to(ShowPeliculas::class);
        //evento para el tipico mensaje de peli creada
        $this->dispatch("mensaje", "Pelicula Creada");
        $this->cancelarCrear();

    }
    public function cancelarCrear(){
        $this->reset(['openModalCrear', 'titulo', 'imagen', 'disponible', 'category_id', 'etiquetas_id', 'sinopsis']);
    }
}
