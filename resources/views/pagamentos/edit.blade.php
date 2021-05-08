<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Editar pagamentos
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2 message">
            @if (isset($_GET['message']))
            {{ $_GET['message'] }}
            @endif
         </div>
         <div class="block mb-8">
               <a href="{{ route('contratos.show', $contrato->id)  }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Voltar para contrato {{$contrato->id}}</a>
         </div>   
         <div class="mt-5 md:mt-0 md:col-span-2 bg-white">
            @foreach($pagamentos as $dt)
               <form method="post" action="{{ route('pagamentos.update', $contrato->id) }}">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" value="{{$dt->id}}">
                  <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
                  <input type="hidden" name="mes_referencia" value="{{$dt->mes_referencia}}">
                  <div class="shadow overflow-hidden sm:rounded-md">
                     
                  <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
                     <label for="datas_rendimento" class="text-lg text-center inline-block my-2 col-span-3 font-bold text-gray-700">{{ substr_replace($dt->mes_referencia, '/', 2, 0) }}</label>
                     <input type="number" name="valor" id="valor" class="form-input my-2 col-span-3 rounded-md shadow-sm mt-1 inline-flex w-half"
                     value="{{$dt->valor}}" />
                     @error('valor')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                     <button class="inline-flex my-2 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Salvar
                     </button>
                  </div>
               </form>
               @endforeach
            </div>
         </div>
   </div>
</x-app-layout>