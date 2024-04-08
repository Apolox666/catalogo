<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Editar un producto</h1>
            <form method="POST" class="p-6" action="{{ route('product.update',$producto->id)}}">
                @csrf
                {{ method_field('PATCH') }}
                <!-- nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del producto *')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" value="{{$producto->name}}" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                 <x-input-label for="name" :value="__('Seleccione a grupo encargado del servicio')" class="pt-8" />
                <div class="mb-4">
                    <input type="text" id="search" class="form-input rounded-md my-4 shadow-sm"
                        placeholder="Buscar por nombre">
                </div>
                @error('groups')
                    <p class="text-red-700 text-xs">{{ $message }}</p>
                @enderror



                <div class="flex flex-wrap  gap-8" id="groups-container">
                    @foreach ($grupos as $grupo)
                        <div class="w-1/4 flex items-center  gap-4 search">
                            <input type="radio" name="groups" value="{{ $grupo->id }}"
                                {{ $producto->group->id == $grupo->id ? 'checked' : '' }}>
                            <p>{{ $grupo->name }}</p>
                        </div>
                    @endforeach
                </div>


                <!-- acciones -->
                <div class="flex items-center justify-end mt-4">
                    <x-cancel-button class="ms-4">
                        {{ __('Cancelar') }}
                    </x-cancel-button>
                    <x-primary-button class="ms-4">
                        {{ __('Editar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}"></script>


</x-app-layout>