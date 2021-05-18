<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{-- Contrato {{ $contrato->id }} --}}
        </h2>
    </x-slot>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> --}}
{{-- 
    <div>
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div> --}}
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
