<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ticket {{ $ticket->id }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('tickets.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Voltar</a>
            </div>
            <form class="inline-block " action="{{route('tickets.update', $ticket->id)}}"  method="POST" onsubmit="return confirm('Tem certeza?');">
                          @csrf
                          @method('PUT')
                          
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="responsavel" value="{{ auth()->user()->id }}">
                          <input type="hidden" name="id" value="{{ $ticket->id }}">
                          <select name="status">
                            @for($i = 1; $i < 4; $i++)
                              <option {{ $ticket->statusAtual($i) }} value="{{$i}}"> {{ $ticket->getStatus($i) }} </option>
                            @endfor
                          </select>
                          <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Alterar">
                          </form>
                        </td>
            {{-- @foreach($alertas as $dt) --}}
                <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4 bg-white">
                     <h3>Ticket {{ $ticket->id }} </h3>
                    <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
                        <label class="text-center inline-block my-5 col-span-7 font-bold text-gray-700"> {{$ticket->mensagem}} </label>
                    </div>
                    <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
                        <label class="text-center inline-block my-5 col-span-7 font-bold text-gray-700"> {{$ticket->status}} </label>
                    </div>
                    @foreach($replicas as $replica)
                        <div class="border-2 border-black col-span-7 rounded-md shadow-sm mt-1 inline-flex w-full">
                            {{$replica->mensagem}}
                        </div>
                    @endforeach
                </div>
            {{-- @endforeach --}}
            <div class="block mt-8">                
                {{-- <a href="{{ route('alertaEdit', ['ticketId' => $ticket->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar Alertas</a> --}}
                @if ($ticket->getStatus($ticket->status) != "Encerrado")
                    <a href="{{ route('replicaCreate', ['replicaId' => $ticket->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Responder</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
