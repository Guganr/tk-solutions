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
            <form method="post" action="{{ route('contratos.update', $contrato->id) }}"  enctype="multipart/form-data">
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
                  
                @for ($i = 0; $i < sizeof($upload); $i++)
                    <a href="{{ $upload[$i]->caminho }}" download> 
                    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 my-2 px-2">
                        <!-- SMALL CARD ROUNDED -->
                        <div class="bg-gray-100 border-indigo-600 dark:bg-gray-800 bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-around cursor-pointer | hover:bg-indigo-400 dark:hover:bg-indigo-600 hover:border-transparent | transition-colors duration-500">
                            <div class="flex flex-col justify-center">
                                <p class="text-gray-900 dark:text-gray-300 font-semibold">{{ $upload[$i]->nome }}</p>
                            </div>
                        </div>
                        <!-- END SMALL CARD ROUNDED -->
                    </div>
                </a>
                @endfor
                  <div class="flex w-full my-5 items-center justify-center bg-grey-lighter">
                     <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Anexe um arquivo</span>
                     <input type='file' name="file_upload_contrato" class="hidden" />
                     </label>
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