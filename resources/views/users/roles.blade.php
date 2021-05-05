<div class="px-4 py-5 bg-white sm:p-6">
    <label for="roles" class="block font-medium text-sm text-gray-700">Roles</label>
    <select name="roles[]" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
        @foreach($roles as $id => $role)
            @if ($role != "Cliente")
                @can('adm_access')
                    <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                @endcan    
            @endif
            @if ($role == "Cliente")
                <option selected value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
            @endif
        @endforeach
    </select>
    @error('roles')
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
