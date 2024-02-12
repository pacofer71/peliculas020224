<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Storage;

class UpdateForm extends Form
{
    public ?Pelicula $pelicula=null;
    public string $titulo="";
    public ?string $disponible=null;
    public $imagen;
    public string $category_id="";
    public array $etiquetas_id=[];
    public string $sinopsis="";

    public function setPelicula(Pelicula $peli){
        $this->pelicula=$peli;
        $this->titulo=$peli->titulo;
        $this->sinopsis=$peli->sinopsis;
        $this->disponible=$peli->disponible;
        $this->category_id=$peli->category_id;
        $this->etiquetas_id=$peli->getTagsId();
    }
    public function rules(): array{
        return [
            'titulo'=>['required', 'string', 'min:3', 'unique:peliculas,titulo,'.$this->pelicula->id],
            'sinopsis'=>['required', 'string', 'min:10'],
            'imagen'=>['nullable', 'image', 'max:2048'],
            'category_id'=>['required', 'exists:categories,id'],
            'etiquetas_id'=>['required', 'array', 'min:1', 'exists:etiquetas,id'],
            'disponible'=>['nullable'],
        ];
    }

    public function actualizar(){
        $this->validate();

        $ruta=$this->pelicula->caratula;
        if($this->imagen){
            if(basename($this->pelicula->caratula)!='noimage.png'){
                Storage::delete($this->pelicula->caratula);
            }
            $ruta=$this->imagen->store('caratulas');
        }
        //Actualiza Peli
        $this->pelicula->update([
            'titulo'=>$this->titulo,
            'sinopsis'=>$this->sinopsis,
            'category_id'=>$this->category_id,
            'caratula'=>$ruta,
            'disponible'=>($this->disponible) ? "SI" : "NO",
        ]);
        //Actualiza sus etiquetas
        $this->pelicula->etiquetas()->sync($this->etiquetas_id);
        //$this->limpiar();

    }
    public function limpiar(){
        $this->reset(['pelicula', 'titulo', 'sinopsis', 'category_id', 'etiquetas_id', 'imagen', 'disponible']);
    }


}
