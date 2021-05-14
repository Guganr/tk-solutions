<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Ticket #{{ $ticket->id }}
        </h2>
   </x-slot>
   <div>
      <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('tickets.index') }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
         
            @if($userRole->isVendedor() || $userRole->isAdmin())
               <form class="inline-block" action="{{route('tickets.update', $ticket->id)}}"  method="POST" onsubmit="return confirm('Tem certeza?');">
               @csrf
               @method('PUT')
               
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="responsavel" value="{{ auth()->user()->id }}">
               <input type="hidden" name="id" value="{{ $ticket->id }}">
               <select name="status" class="bg-black text-white">
                  @for($i = 1; $i < 4; $i++)
                  <option class="text-white" {{ $ticket->statusAtual($i) }} value="{{$i}}"> {{ $ticket->getStatus($i) }} </option>
                  @endfor
               </select>
               @if ($ticket->getStatus($ticket->status) != "Encerrado")
                  <button type="submit" class="inline-flex text-green-500 hover:text-white ml-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
               @endif
               </form>
               @else
               <div class="w-36 text-center py-2 px-5 bg-white font-black"> {{$ticket->getStatus($ticket->status)  }} </div>
               @endif
         <div class="antialiased mx-auto w-full my-4">
            <div class="space-y-4">
               <div class="flex">
                  <div class="flex-1 border border-gray-600 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                     <strong class="text-white">{{ $ticket->cliente() }}</strong> <span class="text-xs text-gray-400">{{date_create($ticket->created_at)->format("d/m/Y y:m")}}</span>
                     <p class="text-sm text-white">
                        {{$ticket->mensagem}}
                     </p>
                     <h4 class="my-5 uppercase tracking-wide text-gray-400 font-bold text-xs">Respostas</h4>
                     <div class="space-y-4">
                        @foreach($replicas as $replica)
                            <div class="flex">
                                <div class="flex-1 bg-black rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                                    <strong class="text-white">{{ $replica->responsavel() }}</strong> <span class="text-xs text-gray-400">{{date_create($replica->created_at)->format("d/m/Y y:m")}}</span>
                                    <p class="text-xs sm:text-sm text-white">
                                        {{$replica->mensagem}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @for ($i = 0; $i < sizeof($upload); $i++)
                    <a href="{{ $upload[$i]->caminho }}" download> 
                    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 my-2 px-2">
                        <!-- SMALL CARD ROUNDED -->
                        <div class="bg-gray-100 border-indigo-600 dark:bg-gray-800 bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-around cursor-pointer | hover:bg-indigo-400 dark:hover:bg-indigo-600 hover:border-transparent | transition-colors duration-500">
                            <div class="flex flex-col justify-center">
                                <p class="text-gray-900 dark:text-gray-300 font-semibold">{{ $upload[$i]->nome }}</p>
                            </div>
                        </div>
                        <!-- END SMALL CARD ROUNDED -->
                    </div>
                </a>
                @endfor
         <div class="block mt-8">                
            @if ($ticket->getStatus($ticket->status) != "Encerrado"  || $userRole->isAcessor())
            <a href="{{ route('replicaCreate', ['replicaId' => $ticket->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Responder</a>
            @endif
         </div>
      </div>
   </div>
</x-app-layout>