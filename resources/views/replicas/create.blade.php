<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Criar ticket
      </h2>
   </x-slot>
   <div>
      <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
         <div class="mt-5 md:mt-0 md:col-span-2 message">
            @if (isset($_GET['message']))
               {{ $_GET['message'] }}
            @endif
         </div>
         <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="grid grid-flow-col grid-rows-1 grid-cols-7 gap-4 p-4">
               {{-- {{ dd($ticket) }} --}}
               <div class="bg-white p-8 col-span-7 rounded-md shadow-sm inline-flex w-ful">
                  <div class="bg-white col-span-7 rounded-md shadow-sm block w-full">
                     <h3>Ticket {{ $ticket->id }} </h3>
                  </div>
                  <div class="bg-white col-span-7 rounded-md shadow-sm block w-full">
                     {{ $ticket->mensagem }}
                  </div>
               </div>
            @foreach($replicas as $replica)
               <div class=" col-span-7 rounded-md shadow-sm mt-1 inline-flex w-full">
                  {{$replica->mensagem}}
               </div>
            @endforeach
            </div>
            <form method="post" action="{{ route('replicas.store') }}">
               @csrf
               <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
               <input type="hidden" name="responsavel" value="{{auth()->user()->id}}">
               <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="datas_rendimento" class="block font-medium text-sm text-gray-700">Datas</label>
                        @error('mes_referencia')
                           <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                  </div>
                  <div class="px-4 py-5 bg-white sm:p-6">
                     <label for="mensagem" class="block font-medium text-sm text-gray-700">Mensagem
                     </label>
                     <textarea name="mensagem" id="mensagem" class="form-input rounded-md shadow-sm mt-1 block w-full"
                        value="{{ old('mensagem', '') }}" ></textarea>
                     @error('mensagem')
                     <p class="text-sm text-red-600">{{ $message }}
                     </p>
                     @enderror
                  </div>
                  <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                     <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                     Criar
                     </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-app-layout>