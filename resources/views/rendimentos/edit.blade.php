<x-app-layout>
   <x-slot name="header">
      <h2 class="font-extrabold text-xl text-white leading-tight">
         Editar Rendimentos (Contrato #{{ $contrato->id }})
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('rendimentos.show', $contrato) }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
         <div class="mt-5 md:mt-0 md:col-span-2 message">
            @if (isset($_GET['message']))
            {{ $_GET['message'] }}
            @endif
         </div>
         <div class="mt-5 md:mt-0 md:col-span-2 bg-white">
            <table class="min-w-full divide-y divide-gray-600 w-full">
               <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                ID
               </th>
               <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                   Mês referência
               </th>
               <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                   Valor
               </th>
               <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                   
               </th>
            @foreach($rendimentos as $r)
               <form method="post" action="{{ route('rendimentos.update', $contrato->id) }}">
                  @csrf
                  @method('PUT')
                                <tr class="border-b border-gray-600">
                                    <td scope="col" class="px-6 py-3 bg-gray-900 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        {{ $r->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                         {{ substr_replace($r->mes_referencia, '/', 2, 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                       <input type="hidden" name="id" value="{{$r->id}}">
                                       <input type="hidden" name="contrato_id" value="{{$contrato->id}}">
                                       <input type="hidden" name="mes_referencia" value="{{$r->mes_referencia}}">
                                       <input type="number" name="valor" id="valor" class="form-input text-white bg-black my-2 col-span-3 rounded-md shadow-sm mt-1 inline-flex w-half"
                                       value="{{$r->valor}}" />
                                       @error('valor')
                                       <p class="text-sm text-red-600">{{ $message }}
                                       </p>
                                       @enderror
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Salvar
                                        </button>
                                     </td>
                                </tr>
                              </form>
                              @endforeach
                           </table>   
            </div>
         </div>
   </div>
</x-app-layout>