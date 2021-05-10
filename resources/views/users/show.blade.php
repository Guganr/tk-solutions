<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-white leading-tight">
            Informações: {{ $user->name }}
        </h2>
    </x-slot>
    
    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('users.index') }}" class="bg-yellow-500 hover:bg-white hover:text-blue-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border border-gray-600 bg-gray-900 text-white sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-600 bg-gray-900 text-white w-full">
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        ID
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        Name
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        Email
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        Data de criação
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                            {{ date_create($user->created_at)->format("d/m/Y") }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        Venededor responsável
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                            {{ $user->vendedor() }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-black text-left text-xs font-black text-white uppercase tracking-wider">
                                        Roles
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm bg-white bg-gray-900 text-white">
                                        @foreach ($user->roles as $role)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-black">
                                                    {{ $role->title }}
                                                </span>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inline-flex  my-8">
                <a href="{{ route('users.edit', $user) }}" class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar Usuário</a>
            </div> 
        </div>
    </div>
</x-app-layout>
