<x-app-layout>
   <x-slot name="header">
      <h2 class="font-extrabold text-xl text-white leading-tight">
         Adicionar Rendimento (Contrato #{{ $contrato->id }})
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('rendimentos.show', $contrato) }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
         <div class="my-10 md:mt-0 md:col-span-2 w-full text-lg text-center font-bold bg-green-500 text-white ">
            @if (isset($_GET['message']))
               {{ $_GET['message'] }}
            @endif
         </div>
         <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('rendimentos.store') }}">
               @csrf
               <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                        <label for="datas_rendimento" class="block font-black text-sm text-white">Datas</label>
                        <select name="mes_referencia" id="datas" class="bg-gray-900 text-white form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                           @foreach($datas_validas as $dt)
                                 <option value="{{ $dt }}">{{ substr_replace($dt, '/', 2, 0) }}</option>
                           @endforeach
                        </select>
                        @error('mes_referencia')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                  </div>
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="valor" class="block font-black text-sm text-white">Valor do rendimento
                     </label>
                     <input type="number" name="valor" id="valor" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('valor', '') }}" />
                     @error('valor')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="flex items-center justify-end px-4 py-3 bg-black text-right sm:px-6">
                     <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Adicionar Rendimentos</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>