<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-4 bg-white rounded-lg shadow-xs">
            <h1 class=" text-black text-3xl p-8 font-bold">Editar un subproceso</h1>
            <form method="POST" class="p-6" action="{{ route('subprocess.update', $subproceso->id) }}">
                {{ method_field('PATCH') }}
                @csrf

                <!-- nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre del subproceso *')" />
                    <x-text-input id="name"
                        class="block mt-6 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                        name="name" value="{{ $subproceso->name }}" autofocus autocomplete="name" />

                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
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


</x-app-layout>
