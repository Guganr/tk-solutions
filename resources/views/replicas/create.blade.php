<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
         Responder ticket #{{$ticket->id}}
      </h2>
   </x-slot>
   <div>      
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="block mb-8">
               <a href="{{ route('tickets.show', $ticket) }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
         </div>
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
            <form method="post" action="{{ route('replicas.store') }}">
               @csrf
               <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
               <input type="hidden" name="responsavel" value="{{auth()->user()->id}}">
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-black sm:p-6">
                     <label for="mensagem" class="block font-medium text-sm text-white">Mensagem
                     </label>
                     <textarea name="mensagem" id="mensagem" class="form-input bg-gray-900 text-white rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('mensagem', '') }}" ></textarea>
                     @error('mensagem')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="flex items-center justify-end px-4 py-3 bg-black text-right sm:px-6">
                     <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-white hover:bg-green-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                     Responder
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>