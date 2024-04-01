<x-guest-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover object-center w-full h-full"
                 src="{{ asset('images/hero2.jpg') }}"
                 alt="Office"/>
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <div>
                    <a class="flex w-44" href="{{route('home')}}">
                        <img src="{{asset('images/logoti.png')}}" width="180px">
                    </a>
                </div>
                
          

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input[ype="email"] -->
                    <div class="mt-4">
                        <x-input-label :value="__('Correo')"/>
                        <x-text-input type="email"
                                 id="email"
                                 name="email"
                                 value="{{ old('email') }}"
                                 class="block w-full"
                                 required
                                 autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input[ype="password"] -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')"/>
                        <x-text-input type="password"
                                 id="password"
                                 name="password"
                                 class="block w-full"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                   

                    <div class="mt-4">
                        <x-primary-button class="block w-full">
                            {{ __('Iniciar sesion') }}
                        </x-primary-button>
                    </div>
                </form>

               

             
            </div>
        </div>
    </div>
</x-guest-layout>
