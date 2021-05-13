<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar {{ $user->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('users.index') }}" class="bg-yellow-500 hover:bg-white hover:text-yellow-500 text-white font-bold py-0 px-2 rounded">< Voltar</a>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2 ">
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md bg-black">
                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="name" class="block font-black text-sm text-white">Nome</label>
                            <input type="text" name="name" id="name" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', $user->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="email" class="block font-black text-sm text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $user->email) }}" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="password" class="block font-black text-sm text-white">Senha</label>
                            <input type="password" name="password" id="password" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="roles" class="block font-black text-sm text-white">Roles</label>
                            <select name="roles[]" id="roles" class="bg-gray-900 text-white form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($roles as $id => $role)
                                    @if ($role != "Cliente" && $role != "Acessor")
                                        @can('adm_access')
                                            <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                    @if ($role == "Cliente")
                                        @can('vendedor_access')
                                        <option selected value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                    @if ($role == "Acessor")
                                        @can('vendedor_access')
                                        <option  value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                @endforeach
                            </select>
                            @error('roles')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="shadow flex items-center justify-end px-4 py-3 bg-black text-right sm:px-6 border-t border-gray-900">
                            <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:text-green-500 hover:bg-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Editar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>