<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Contratos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="block mb-8">
                <a href="{{ route('contratos.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Criar Contrato</a>
            </div>
          @can('acessor_access')
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Identificação do contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data da Assinatura
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Valor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data do Início da vigência
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data de vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Duração do Contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Dias para vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Alerta
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Ações
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($contratos as $contrato)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date_create($contrato->data_assinatura)->format('d/m/Y') }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->valor }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date_create($contrato->data_inicio_vigencia)->format('d/m/Y') }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date_create($contrato->data_vencimento)->format('d/m/Y') }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->getDuracaoContrato() }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->getDiasParaVencimento() }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->alerta }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <a href="{{ route('contratos.show', $contrato->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                          <a href="{{ route('contratos.edit', $contrato->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                          <form class="inline-block" action="{{route('contratos.destroy', $contrato->id)}}"  method="POST" onsubmit="return confirm('Are you sure?');">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                          </form>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endcan
          @can('cliente_access')
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Identificação do contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data da Assinatura
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Valor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data do Início da vigência
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data de vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Duração do Contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Dias para vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Ações
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($contratoCliente as $contrato)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->data_assinatura }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->valor }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->data_inicio_vigencia }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->data_vencimento }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <a href="{{ route('contratos.show', $contrato->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                          
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endcan

        </div>
    </div>
</x-app-layout>
