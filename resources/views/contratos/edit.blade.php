<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Contrato {{ $contrato->id }}
        </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('contratos.index') }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
         <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('contratos.update', $contrato->id) }}">
               @csrf
            @method('PUT')
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_assinatura" class="block font-medium text-sm text-white">Data da Assinatura
                     </label>
                     <input type="date" name="data_assinatura" id="data_assinatura" type="date" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_assinatura', $contrato->data_assinatura) }}" />
                     @error('data_assinatura')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="valor" class="block font-medium text-sm text-white">Valor
                     </label>
                     <input type="number" name="valor" id="valor" type="number" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('valor', $contrato->valor) }}" />
                     @error('valor')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_inicio_vigencia" class="block font-medium text-sm text-white">Data do início da vigência
                     </label>
                     <input type="date" name="data_inicio_vigencia" id="data_inicio_vigencia" type="date" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_inicio_vigencia', $contrato->data_inicio_vigencia) }}" />
                     @error('data_inicio_vigencia')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_vencimento" class="block font-medium text-sm text-white">Data vencimento
                     </label>
                     <input type="date" name="data_vencimento" id="data_vencimento" type="date" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_vencimento', $contrato->data_vencimento) }}" />
                     @error('data_vencimento')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               
                  <div class="shadow overflow-hidden sm:rounded-md">
                     <div class="px-4 py-5 bg-black sm:p-6">
                        <label for="acessores" class="block font-medium text-sm text-white">Acessores</label>
                        <select name="acessor_id" id="acessor_id" class="bg-gray-900 text-white form block rounded-md shadow-sm mt-1 block w-full" >  
                           <option  value="0"> -- selecione um acessor -- </option>
                           @foreach($acessores as $acessor)
                              <option  value="{{ $acessor->id }}" {{ $acessor->id == $contrato->acessor_id ? ' selected' : ''  }}>{{ $acessor->name }}</option>
                           @endforeach
                        </select>
                        @error('acessor_id')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                     </div>
                  
                  <div class="flex items-center justify-end px-4 py-3 bg-black border-t border-gray-600 text-right sm:px-6">
                     <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white hover:text-green-500 uppercase tracking-widest hover:bg-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                     Editar Contrato
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>