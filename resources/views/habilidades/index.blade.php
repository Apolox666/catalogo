<x-app-layout>


    <div class="relative overflow-x-auto p-8">
        <div class="p-8 bg-white  shadow-xs rounded-xl">
            <h1 class=" text-black text-3xl py-8 font-bold">Actividades/Habilidades</h1>
            <a href="">
                <button
                    class="rounded-lg relative w-36 h-10 cursor-pointer flex items-center border mb-4 border-green-500 bg-green-500 group hover:bg-green-500 active:bg-green-500 active:border-green-500">
                    <span
                        class="text-white font-bold ml-8 transform group-hover:translate-x-20 transition-all duration-300">Añadir
                    </span>
                    <span
                        class="absolute right-0 h-full w-10 rounded-lg bg-green-500 flex items-center justify-center transform group-hover:translate-x-0 group-hover:w-full transition-all duration-300">
                        <svg class="svg w-8 text-white" fill="none" height="24" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            width="24" xmlns="http://www.w3.org/2000/svg">
                            <line x1="12" x2="12" y1="5" y2="19"></line>
                            <line x1="5" x2="19" y1="12" y2="12"></line>
                        </svg>
                    </span>
                </button>

            </a>
            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <table class="table" id="Table">
                   
                    <thead>
                        <tr>
                          <th scope="col">Nombre</th>
                          <th scope="col">Responsables</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                   
                        <tr>
                          <td></td>
                          <td></td>
                          <td>
                       
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
         $('#Table').DataTable();
        });
      </script>
  
</x-app-layout>

