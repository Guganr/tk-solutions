<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Contrato {{ $contrato->id }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('contratos.index') }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="shadow py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border border-gray-600 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-600 w-full">
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        ID
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->id }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        data_assinatura
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ date_create($contrato->data_assinatura)->format("d/m/Y") }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        valor
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->valor }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        data_inicio_vigencia
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ date_create($contrato->data_inicio_vigencia)->format("d/m/Y") }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        data_vencimento
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ date_create($contrato->data_vencimento)->format("d/m/Y") }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        duracao_contrato
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->getDuracaoContrato() }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        dias_para_vencimento
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->getDiasParaVencimento() }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        alerta
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->alerta }}
                                    </td>
                                </tr>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        cliente
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->cliente() }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        vendedor
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        {{ $contrato->vendedor() }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        <label>Rendimentos</label>
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        <a href="{{ route('rendimentos.show', $contrato->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ver rendimentos</a>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        <label>Alertas</label>
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        <a href="{{ route('alertas.show', $contrato->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ver alertas</a>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-600">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-medium text-white uppercase tracking-wider">
                                        <label>pagamentos</label>
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900 divide-y divide-gray-600">
                                        <a href="{{ route('pagamentos.show', $contrato->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ver pagamentos</a>
                                    </td>
                                </tr>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <ul>
            </ul>
            <div class="block mt-8">
                <a href="{{ route('contratos.edit', $contrato->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
            </div>
        </div>
    </div>
</x-app-layout>
