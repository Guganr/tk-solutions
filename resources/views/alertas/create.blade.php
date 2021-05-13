<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Alertas (Contrato #{{ $contrato->id }})
        </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2 message">
            <div class="block mb-8">
                <a href="{{ route('alertas.show', $contrato->id) }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
         <div class="my-10 md:mt-0 md:col-span-2 w-full text-lg text-center font-bold bg-green-500 text-white ">
            @if (isset($_GET['message']))
            {{ $_GET['message'] }}
            @endif
         </div>
         </div>
         <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('alertas.store') }}">
               @csrf
               <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5  sm:p-6 bg-black">
                     <label for="mensagem" class="block font-black text-sm text-white ">Mensagem
                     </label>
                     <textarea name="mensagem" id="mensagem" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                     @error('mensagem')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="flex items-center justify-end px-4 py-3  bg-black text-right sm:px-6">
                     <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                     Criar
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>