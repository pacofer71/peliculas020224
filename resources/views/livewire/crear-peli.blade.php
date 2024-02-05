<div>
    <x-button><i class="fas fa-add mr-2"></i>Nueva</x-button>
    <x-dialog-modal>
        <x-slot name="title">
            Crear Película
        </x-slot>
        <x-slot name="content">
            
            <x-label for="titulo">Título</x-label>
            <x-input type="text" id="titulo" placeholder="Título" class="w-full mb-3" />
            
            <x-label for="sinopsis">Sinópsis</x-label>
            <textarea class="w-full mb-3" placeholder="Sinopsis..." id="sinopsis"></textarea>

            <x-label for="category_id">Categoría</x-label>
            <select id="category_id" class="w-full mb-3">
                <option>Selecciona una categoría....</option>
            </select>

            <x-label for="disponible">Disponible</x-label>
            <input type="checkbox" value="SI" id="disponible" class="mb-3"> Disponible

        </x-slot>
        <x-slot name="footer">
            Botones
        </x-slot>
    </x-dialog-modal>
</div>
