<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Pagamentos (Contrato #{{ $contrato->id }})
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('contratos.show', $contrato->id) }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="shadow py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border border-gray-600 sm:rounded-lg">
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
                                @foreach($pagamentos as $pagamento)
                                <tr class="border-b border-gray-600">
                                    <td scope="col" class="px-6 py-3 bg-gray-900 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        {{ $pagamento->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                         {{ substr_replace($pagamento->mes_referencia, '/', 2, 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        R${{$pagamento->valor}}
                                    </td>
                                </tr>
                                
                            @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <ul>
            </ul>
            <div class="block mt-8">
              @if(!$userRole->isCliente())
                <a href="{{ route('pagamentoCreate', ['pagamentoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Adicionar Pagamentos</a>
                <a href="{{ route('pagamentoEdit', ['pagamentoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar Pagamentos</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>