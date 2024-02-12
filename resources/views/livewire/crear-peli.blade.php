<div>
    <x-button wire:click="$set('openModalCrear', true)"><i class="fas fa-add mr-2"></i>Nueva</x-button>
    <x-dialog-modal wire:model="openModalCrear">
        <x-slot name="title">
            Crear Película
        </x-slot>
        <x-slot name="content">

            <x-label for="titulo">Título</x-label>
            <x-input type="text" id="titulo" placeholder="Título" class="w-full mb-3" wire:model="titulo" />
            <x-input-error for="titulo" />

            <x-label for="sinopsis">Sinópsis</x-label>
            <textarea class="w-full mb-3" placeholder="Sinopsis..." id="sinopsis" wire:model="sinopsis"></textarea>
            <x-input-error for="sinopsis" />

            <x-label for="category_id">Categoría</x-label>
            <select id="category_id" class="w-full mb-3" wire:model="category_id">
                <option>Selecciona una categoría....</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            <x-input-error for="category_id" />

            <x-label for="disponible">Disponible</x-label>
            <div class="flex items-center mb-3">
                <input id="disponible" type="checkbox" value="SI" wire:model="disponible"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
            </div>
            <x-input-error for="disponible" />

            <x-label for="etiquetas_id">Etiquetas</x-label>
            <div class="flex mb-3">
                @foreach ($etiquetas as $etiqueta)
                    <div class="flex items-center me-4">
                        <input id="{{ $etiqueta->nombre }}" type="checkbox" value="{{ $etiqueta->id }}"
                            wire:model="etiquetas_id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{ $etiqueta->nombre }}"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            <p class="px-1 py-1 rounded-lg" style="background-color:{{ $etiqueta->color }}">
                                {{ $etiqueta->nombre }}</p>
                        </label>
                    </div>
                @endforeach
            </div>
            <x-input-error for="etiquetas_id" />


            <x-label for="imagenC">Poster</x-label>
            <div class="w-full h-80 bg-gray-200 relative">
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-full bg-center bg-cover bg-no-repeat" />
                @endif
                <input type="file" accept="image/*" hidden id="imagenC" wire:model="imagen" wire:loading.attr="disabled" />
                <label for="imagenC"
                    class="absolute bottom-2 right-2 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i>SUBIR
                </label>
            </div>
            <x-input-error for="imagen" />

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="store" wire:loading.attr="disabled" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> GUARDAR
                </button>

                <button wire:click="cancelarCrear"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
