<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Tickets
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
                        {{-- Filtro de busca --}}
                        <div class="inline-flex mb-8">
                            <a href="{{ route('tickets.index', [ 'filter[status]' => '1']) }}" class="{{ str_contains(url()->full(), 'vendedor') ? "bg-white hover:bg-blue-300 hover:text-white text-blue-300 font-bold py-0 px-4 rounded" : "bg-blue-300 hover:bg-white hover:text-blue-300 text-white font-bold py-0 px-4 rounded" }}">Aberto</a>
                        </div> 
                        <div class="inline-flex mb-8">
                            <a href="{{ route('tickets.index',[ 'filter[status]' => '2']) }}" class="{{ str_contains(url()->full(), 'cliente') ? "bg-white hover:bg-blue-300 hover:text-white text-blue-300 font-bold py-0 px-4 rounded" : "bg-blue-300 hover:bg-white hover:text-blue-300 text-white font-bold py-0 px-4 rounded" }}">Em andamento</a>
                        </div> 
                        <div class="inline-flex mb-8">
                            <a href="{{ route('tickets.index',[ 'filter[status]' => '3']) }}" class="{{ str_contains(url()->full(), 'acessor') ? "bg-white hover:bg-blue-300 hover:text-white text-blue-300 font-bold py-0 px-4 rounded" : "bg-blue-300 hover:bg-white hover:text-blue-300 text-white font-bold py-0 px-4 rounded" }}">Encerrado</a>
                        </div> 
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-600">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Identificação do ticket
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Mensagem
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Data
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-black text-gray-500 bg-black uppercase tracking-wider">
                          Ações
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-gray-900 text-white divide-y divide-gray-600">
                      @foreach ($tickets as $ticket)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $ticket->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ $ticket->mensagem }}
                        </td>
                        
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date_create($ticket->created_at)->format("d/m/Y") }}
                        </td>
                        
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                          <form class="inline-block" action="{{route('tickets.update', $ticket->id)}}"  method="POST" onsubmit="return confirm('Tem certeza?');">
                          @csrf
                          @method('PUT')
                          
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="responsavel" value="{{ auth()->user()->id }}">
                          <input type="hidden" name="id" value="{{ $ticket->id }}">
                          <select name="status" class="bg-black">
                            @for($i = 1; $i < 4; $i++)
                              <option {{ $ticket->statusAtual($i) }} value="{{$i}}"> {{ $ticket->getStatus($i) }} </option>
                            @endfor
                          </select>
                          @if ($ticket->getStatus($ticket->status) != "Encerrado")
                            <button type="submit" class="inline-flex text-green-500 hover:text-white ml-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                          @endif
                          </form>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <a href="{{ route('tickets.show', $ticket->id) }}" class="inline-flex text-blue-300 hover:text-white mb-2 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>              
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
