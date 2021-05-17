<x-app-layout>
    <x-slot name="header">
      <h2 class="font-extrabold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Identificação do contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Data da Assinatura
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Valor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Data do Início da vigência
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Data de vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Duração do Contrato
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Dias para vencimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Vendedor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Ações
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-600 text-white">
                      @foreach ($contratos as $contrato)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $contrato->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date_create($contrato->data_assinatura)->format('d/m/Y') }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          R${{ $contrato->valor }}
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
                          {{ $contrato->vendedor() }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-black">
                          <a href="{{ route('contratos.show', $contrato->id) }}" class="inline-flex text-blue-300 hover:text-white mb-2 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                        <a href="{{ route('contratos.edit', $contrato->id) }}" class="inline-flex text-green-500 hover:text-white mb-2 mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></a>
                        <form class="inline-block" action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="inline-flex text-red-500 hover:text-white mb-2 mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </form>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        <div class="shadow-lg overflow-hidden border-b border-gray-600 sm:rounded-lg my-6">
                <h2 class="text-white">Clientes</h2>
                            <table class="min-w-full divide-y divide-gray-600 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-black text-left text-xs font-black text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-gray-500 uppercase tracking-wider">
                                        Data de criação
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-gray-500 uppercase tracking-wider">
                                        Roles
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-black">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-600">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900">
                                            {{ $user->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900">
                                            {{ $user->email }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900">
                                            {{ date_create($user->created_at)->format("d/m/Y") }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white bg-gray-900">
                                            @foreach ($user->roles as $role)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-black">
                                                    {{ $role->title }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium bg-gray-900">
                                            <a href="{{ route('users.show', $user->id) }}" class="inline-flex text-blue-300 hover:text-white mb-2 mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="inline-flex text-green-500 hover:text-white mb-2 mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></a>
                                            <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="inline-flex text-red-500 hover:text-white mb-2 mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
    </div>
        </div>
 --}}

 <h3 class="mx-10 text-white font-black">Contratos Assinados</h3>
    <div id="chart-contratos" style="height: 300px;"></div>
    <h3 class="mx-10 text-white font-black">Valores Recebidos</h3>
    <div id="chart-valores-recebidos" style="height: 300px;"></div>
    <h3 class="mx-10 text-white font-black">Valores Recebidos e Movimentados</h3>
    <div id="chart-valores-recebidos-movimentados" style="height: 300px;"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chartContrato = new Chartisan({
        el: '#chart-contratos',
        url: "@chart('contrato_chart')",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .datasets([{ type: 'line', fill: false }, { type: 'line', fill: false }]),
      });
      
      const chartValoresRecebidos = new Chartisan({
        el: '#chart-valores-recebidos',
        url: "@chart('valores_recebidos_chart')",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
      });
      const chartValoresRecebidosMovimentados = new Chartisan({
        el: '#chart-valores-recebidos-movimentados',
        url: "@chart('valores_recebidos_movimentados_chart')",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
      });
    </script>
</x-app-layout>
