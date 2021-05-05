<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ClienteVendedor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class UsersController extends Controller 
{
    public function index() {

        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = QueryBuilder::for(User::class)
                            ->allowedIncludes('roles')
                            ->allowedFilters('roles.title')
                            ->paginate(10);

        
        return view('users.index', compact('users'));
    }

    public function create() {

        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request) {
        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));
        $clienteVendedor = new ClienteVendedor();
        $clienteVendedor-> cliente_id = $user->id;
        $clienteVendedor-> vendedor_id = auth()->user()->id;
        $clienteVendedor->save();
        return redirect()->route('users.index');
    }

    public function show(User $user) {

        abort_if(Gate::denies('cliente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('users.show', compact('user'));
    }

    public function edit(User $user) {

        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user) {

        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user->update($request->validated());
        // $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function destroy(User $user) {

        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('users.index');
    }
}
