<?php

namespace App\Livewire;

use App\Models\Pelicula;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPeliculas extends Component
{
    use WithPagination;

    public string $campo="pid";
    public string $orden="desc";
    public string $buscar="";

    public function render()
    {
        $peliculas=Pelicula::join('categories', 'categories.id', '=', 'category_id')
        ->select('peliculas.id as pid', 'caratula', 'disponible', 'titulo', 'nombre')
        ->where('titulo', 'like', '%'.$this->buscar.'%')
        ->orWhere('nombre', 'like', "%{$this->buscar}%")
        ->orWhere('disponible', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);
        return view('livewire.show-peliculas', compact('peliculas'));
    }
    public function ordenar($campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    public function updatingBuscar(){
        $this->resetpage();
    }
}
