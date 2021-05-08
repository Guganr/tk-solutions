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
            @foreach($pagamentos as $dt)
                <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
                    <label for="datas_pagamento" class="text-lg text-center inline-block my-2 col-span-3 font-bold text-gray-700">{{ substr_replace($dt->mes_referencia, '/', 2, 0) }}</label>
                    <label type="number" name="valor" id="valor" class="text-center inline-block my-2 col-span-3 font-bold text-gray-700"> {{$dt->valor}} </label>
                </div>
            @endforeach
            <div class="block mt-8">                
                <a href="{{ route('pagamentoCreate', ['pagamentoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Adicionar pagamentos</a>
                <a href="{{ route('pagamentoEdit', ['pagamentoId' => $contrato->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar pagamentos</a>

            </div>
        </div>
    </div>
</x-app-layout>
