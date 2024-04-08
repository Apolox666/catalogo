<x-app-layout>
    <div class="p-4  flex  justify-center items-center h-full">
        <div class=" max-w-7xl mx-auto w-full shadow-lg">
            <div class="bg-white l rounded-3xl p-8 mb-5">
                <h1 class="text-3xl font-bold mb-10">Bienvenid@ {{ auth()->user()->name }} =)</h1>
                <hr class="my-10">

                <div class=" gap-x-20">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Resumen del catalogo TI</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <div class="p-4 bg-green-400 rounded-xl">
                                    <div class="font-bold text-xl text-gray-800 leading-none">Listado de productos
                                    </div>
                                    <div class="mt-5">
                                        <button type="button"
                                            class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                            Revisar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-yellow-300 rounded-xl text-gray-800">
                                <div class="font-bold text-2xl leading-none">{{ $service}}</div>
                                <div class="mt-2">Servicios activos</div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-blue-500 font-bold rounded-xl text-white">
                                    <div class="font-bold text-2xl leading-none">{{ $groups }}</div>
                                    <div class="mt-2"></div>grupos
                                </div>
                                <div class="p-4 bg-indigo-500 font-bold rounded-xl text-white">
                                    <div class="font-bold text-2xl leading-none">{{ $responsible }}</div>
                                    <div class="mt-2"></div>Responsables
                                </div>
                            </div>


                            <div class="col-span-2">
                                <div class="p-4 bg-purple-500 rounded-xl text-white">
                                    <div class="font-bold text-xl leading-none">Total actividades</div>
                                    <div class="mt-2">{{$activity}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



</x-app-layout>
