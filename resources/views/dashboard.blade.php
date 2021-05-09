<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>Sales Chart</h2>
                <div id="sales-chart-container" style="height: 400px;"></div>
                {{-- <x-jet-welcome /> --}}
            </div>
        </div>
    </div>
    @push('js')
    <script>
    console.log("asd");
      const salesChart = new Chartisan({
        el: '#sales-chart-container',
        url: "@chart('sales_chart')",
      });
    </script>
    @endpush
</x-app-layout>
