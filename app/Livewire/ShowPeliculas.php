<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateForm;
use App\Models\Category;
use App\Models\Etiqueta;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPeliculas extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo="pid";
    public string $orden="desc";
    public string $buscar="";
    public bool $openModalUpdate=false;

    public UpdateForm $form;

    public Pelicula $pelicula;
    public bool $openModalDetalle=false;
    


    #[On('evento_pelicula_creada')]
    public function render()
    {
        $peliculas=Pelicula::join('categories', 'categories.id', '=', 'category_id')
        ->select('peliculas.id as pid', 'caratula', 'disponible', 'titulo', 'nombre')
        ->where('titulo', 'like', '%'.$this->buscar.'%')
        ->orWhere('nombre', 'like', "%{$this->buscar}%")
        ->orWhere('disponible', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);

        $etiquetas=Etiqueta::select("id", "nombre", "color")->orderBy('nombre')->get();
        $categorias=Category::select("id", "nombre")->orderBy('nombre')->get();

        return view('livewire.show-peliculas', compact('peliculas', 'etiquetas', 'categorias'));
    }
    public function ordenar($campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    public function updatingBuscar(){
        $this->resetpage();
    }

    //----------- Esto para borrar una pelicula
    public function pedirConfirmacion($id){
        $this->dispatch('confirmar', $id);
        
    }
    #[On('borrarOk')]
    public function borrarPelicula(Pelicula $peli){
        //Comprobamos si borro la imagen
        if(basename($peli->caratula)!='noimage.png'){
            Storage::delete($peli->caratula);
        }
        $peli->delete();

        $this->dispatch('mensaje', 'Pelicula Borrada');
    }
    //-------------Actualizar disponible
    public function actualizarDisponibilidad(Pelicula $peli){
        $disponible=($peli->disponible=='SI') ? 'NO' : 'SI';
        $peli->update([
            'disponible'=>$disponible,
        ]);
    }

    // Metodos para update
    public function edit(Pelicula $peli){
        $this->form->setPelicula($peli);
        $this->openModalUpdate=true;
    }
    public function update(){
        $this->form->actualizar();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Pelicula actualizada');
    } 
    public function cancelarUpdate(){
        $this->form->limpiar();
        $this->openModalUpdate=false;
    }

    // Detalle Pelicula
    public function detalle(Pelicula $peli){
        $this->pelicula=$peli;
        $this->openModalDetalle=true;
    }
    public function cancelarDetalle(){
        $this->reset(['openModalDetalle', 'pelicula']);
    }

}
