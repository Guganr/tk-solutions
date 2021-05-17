<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ClienteVendedor;
use App\Models\Role;
use App\Models\User;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    public function index() {
        abort_if(Gate::vendedorAcessor() && $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = QueryBuilder::for(User::class)
                            ->allowedIncludes('roles')
                            ->allowedFilters('roles.title')
                            ->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create() {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $userRole = User::find(24);
        return view('users.create', compact(['roles', 'userRole']));
    }

    public function store(StoreUserRequest $request) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->validated()) {
            $user->save();
            $user->roles()->sync($request->input('roles', []));
            $clienteVendedor = new ClienteVendedor();
            $clienteVendedor-> cliente_id = $user->id;
            $clienteVendedor-> vendedor_id = auth()->user()->id;
            $clienteVendedor->save();
        }
        return redirect()->route('users.index');
    }

    public function show(User $user) {
        abort_if(Gate::vendedorAcessor() && $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('users.show', compact('user'));
    }

    public function edit(User $user) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        $user->load('roles');
        $userRole = User::find(24);
        return view('users.edit', compact(['user','userRole', 'roles']));
    }

    public function update(UpdateUserRequest $request, User $user) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->password = Hash::make($request->password);
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->delete();
        return redirect()->route('users.index');
    }
}
