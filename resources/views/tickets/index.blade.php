<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="block mb-8">
                <a href="{{ route('tickets.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Criar ticket</a>
            </div>
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Identificação do ticket
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Mensagem
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Data
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Ações
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($tickets as $ticket)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $ticket->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $ticket->mensagem }}
                        </td>
                        
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $ticket->created_at->format("d/m/Y") }}
                        </td>
                        
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          <form class="inline-block" action="{{route('tickets.update', $ticket->id)}}"  method="POST" onsubmit="return confirm('Tem certeza?');">
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
                          @if ($ticket->getStatus($ticket->status) != "Encerrado")
                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Alterar">
                          @endif
                          </form>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <a href="{{ route('tickets.show', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>                
                          @if ($ticket->getStatus($ticket->status) != "Encerrado")
                            <a href="{{ route('replicaCreate', ['replicaId' => $ticket->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Responder</a>
                          @endif
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            {{ $tickets->links() }}
          </div>
         

        </div>
    </div>
</x-app-layout>
