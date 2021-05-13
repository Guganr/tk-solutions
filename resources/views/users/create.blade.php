<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Criar usuário
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="name" class="block font-black text-sm text-white">Nome</label>
                            <input type="text" name="name" id="name" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', '') }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="email" class="block font-black text-sm text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', '') }}" />
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
                            <label for="password_confirmation" class="block font-black text-sm text-white">Digite novamente a senha </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-900 text-white form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('password_confirmation')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-black sm:p-6">
                            <label for="roles" class="block font-black text-sm text-white">Roles</label>
                            <select name="roles[]" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                @foreach($roles as $id => $role)
                                    @if ($role != "Cliente" && $role != "Acessor")
                                        @can('adm_access')
                                            <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                    @if ($role == "Cliente")
                                        @can('acessor_access')
                                        <option selected value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                    @if ($role == "Acessor")
                                        @can('acessor_access')
                                        <option  value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                        @endcan    
                                    @endif
                                @endforeach
                            </select>
                            @error('roles')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-black text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-black text-xs text-white uppercase tracking-widest hover:bg-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Criar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>