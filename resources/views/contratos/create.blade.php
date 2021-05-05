<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Criar Contrato
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('contratos.store') }}">
               @csrf
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="data_assinatura" class="block font-medium text-sm text-gray-700">Data da Assinatura
                     </label>
                     <input type="date" name="data_assinatura" id="data_assinatura" type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_assinatura', '') }}" />
                     @error('data_assinatura')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="valor" class="block font-medium text-sm text-gray-700">Valor
                     </label>
                     <input type="number" name="valor" id="valor" type="number" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('valor', '') }}" />
                     @error('valor')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="data_inicio_vigencia" class="block font-medium text-sm text-gray-700">Data do início da vigência
                     </label>
                     <input type="date" name="data_inicio_vigencia" id="data_inicio_vigencia" type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_inicio_vigencia', '') }}" />
                     @error('data_inicio_vigencia')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="data_vencimento" class="block font-medium text-sm text-gray-700">Data vencimento
                     </label>
                     <input type="date" name="data_vencimento" id="data_vencimento" type="date" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('data_vencimento', '') }}" />
                     @error('data_vencimento')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="clientes" class="block font-medium text-sm text-gray-700">clientes</label>
                        <select name="clientes[]" id="clientes" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                           @foreach($clientes as $cliente)
                              <option  value="{{ $cliente->id }}"{{ in_array($cliente->id, old('clientes', [])) ? ' selected' : '' }}>{{ $cliente->name }}</option>
                           @endforeach
                        </select>
                        @error('clientes')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                  </div>
                  <div class="shadow overflow-hidden sm:rounded-md">
                     <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="alerta" class="block font-medium text-sm text-gray-700">Alerta
                        </label>
                        <input type="text" name="alerta" id="alerta" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                           value="{{ old('alerta', '') }}" />
                        @error('alerta')
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
      </div>
   </div>
</x-app-layout>