<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl py-8 font-bold">Crear grupo de trabajo</h1>
            <form method="POST" class="p-6" action="{{ route('group.store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del grupo')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" :value="old('name')" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-700 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <x-input-label for="name" :value="__('Seleccione quienes pertenecerán a este grupo')" class="pt-8" />
                <div class="mb-4">
                    <input type="text" id="search" class="form-input rounded-md my-4 shadow-sm" placeholder="Buscar por nombre">
                </div>

                @error('responsibles')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror
                <div class="flex flex-wrap gap-8" id="responsibles-container">
                    @foreach ($responsibles as $responsible)
                        <div class="w-1/4 flex items-center gap-4 responsible">
                            <input type="checkbox" name="responsibles[]" value="{{ $responsible->id }}">
                            <p>{{ $responsible->name }}</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <x-cancel-button class="ms-4">
                        {{ __('Cancelar') }}
                    </x-cancel-button>
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchText = $(this).val().trim().toLowerCase();
                $('.responsible').each(function() {
                    var name = $(this).find('p').text().trim().toLowerCase();
                    if (name.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</x-app-layout>
