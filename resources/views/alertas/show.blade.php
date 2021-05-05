<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contrato {{ $contrato->id }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('contratos.show', $contrato->id) }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Voltar</a>
            </div>
            @foreach($alertas as $dt)
                <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
                    <label for="datas_rendimento" class="text-lg text-center inline-block my-2 col-span-3 font-bold text-gray-700">{{ $dt->created_at->format("d/m/Y h:m") }}</label>
                    <label type="number" name="valor" id="valor" class="text-center inline-block my-2 col-span-3 font-bold text-gray-700"> {{$dt->mensagem}} </label>
                </div>
            @endforeach
            <div class="block mt-8">                
                <a href="{{ route('alertaCreate', ['contratoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Adicionar Alertas</a>
                {{-- <a href="{{ route('alertaEdit', ['contratoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar Alertas</a> --}}

            </div>
        </div>
    </div>
</x-app-layout>
