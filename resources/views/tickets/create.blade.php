<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Abrir Ticket
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2 message">
         </div>
         <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('tickets.store') }}">
               @csrf
               <input type="hidden" name="status" value="1">
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="mensagem" class="block font-medium text-sm text-gray-700">Mensagem
                     </label>
                     <textarea name="mensagem" id="mensagem" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                     @error('mensagem')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                     <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                     Criar
                     </button>
                  </div>
               </div>
            </form>
         </div>
         <div class="block mt-8">             
                <a href="{{ route('tickets.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Voltar</a>
         </div>
      </div>
   </div>
</x-app-layout>