<x-app-layout>
   <x-slot name="header">
        <h2 class="font-extrabold text-xl text-white leading-tight">
            Criar Contrato
        </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="block mb-8">
                <a href="{{ route('contratos.index') }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
            <form method="post" action="{{ route('contratos.store') }}"  enctype="multipart/form-data">
               @csrf
               <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="tipo_contrato" class="block font-black text-sm text-white">Tipo Contrato</label>
                     <select name="tipo_contrato" id="tipo_contrato" class="form-multiselect block rounded-md  bg-gray-900 text-white shadow-sm mt-1 block w-full" >
                        <option value="1">Investimento</option>
                     </select>
                     @error('clientes')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_assinatura" class="block font-black text-sm text-white">Data da Assinatura
                     </label>
                     <input type="date" name="data_assinatura" id="data_assinatura" type="date" class="form-input bg-gray-900 text-white rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_assinatura', '') }}" />
                     @error('data_assinatura')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="valor" class="block font-black text-sm text-white">Valor
                     </label>
                     <input type="number" name="valor" id="valor" type="number" class="form-input bg-gray-900 text-white rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('valor', '') }}" />
                     @error('valor')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_inicio_vigencia" class="block font-black text-sm text-white">Data do início da vigência
                     </label>
                     <input type="date" name="data_inicio_vigencia" id="data_inicio_vigencia" type="date" class="form-input bg-gray-900 text-white rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_inicio_vigencia', '') }}" />
                     @error('data_inicio_vigencia')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="data_vencimento" class="block font-black text-sm text-white">Data vencimento
                     </label>
                     <input type="date" name="data_vencimento" id="data_vencimento" type="date" class="form-input bg-gray-900 text-white rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_vencimento', '') }}" />
                     @error('data_vencimento')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="px-4 py-5 bg-black sm:p-6">
                        <label for="clientes" class="block font-black text-sm text-white">Clientes</label>
                        <select name="clientes[]" id="clientes" class="form-multiselect block rounded-md  bg-gray-900 text-white shadow-sm mt-1 block w-full" >
                           @if (auth()->user()->getUserRole()->get()[0]->id > 1)
                              @foreach($clientes as $cliente)
                                 <option  value="{{ $cliente->id }}"{{ in_array($cliente->id, old('clientes', [])) ? ' selected' : '' }}>{{ $cliente->name }}</option>
                              @endforeach
                           @else
                              @foreach($todosClientes as $cliente)
                                 <option  value="{{ $cliente->id }}"{{ in_array($cliente->id, old('clientes', [])) ? ' selected' : '' }}>{{ $cliente->name }}</option>
                              @endforeach
                           @endif
                        </select>
                        @error('clientes')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                  </div>
                  <div class="shadow overflow-hidden sm:rounded-md">
                     
                     <div class="px-4 py-5 bg-black sm:p-6">
                        <label for="acessores" class="block font-black text-sm text-white">Acessores</label>
                        <select name="acessor_id" id="acessor_id" class="form bg-gray-900 text-white  block rounded-md shadow-sm mt-1 block w-full" >  
                           <option  value="0"> -- selecione um acessor -- </option>
                           @foreach($acessores as $acessor)
                              <option  value="{{ $acessor->id }}">{{ $acessor->name }}</option>
                           @endforeach
                        </select>
                        @error('acessor_id')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                     </div>
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
                     Criar Contrato
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>