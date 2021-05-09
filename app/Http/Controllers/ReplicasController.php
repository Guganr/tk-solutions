<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplicaRequest;
use App\Models\Replica;
use App\Models\Ticket;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;

class ReplicasController extends Controller {
    
    public function create($id) {
        abort_if(Gate::clienteVendedor() || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidde');
        $checkVendedor = $this->ticketPertenceAoVendedor();
        $checkCliente = $this->ticketPertenceAoCliente();
        abort_if(empty($checkVendedor || $checkCliente) || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ticket = Ticket::find($id);
        $replicas = Replica::where('ticket_id', $id)->get();
        $ticket->load('replicas');
        return view('replicas.create', compact(["ticket", 'replicas']));
    }

    public function store(StoreReplicaRequest $request) {
        abort_if(Gate::clienteVendedor() , Response::HTTP_FORBIDDEN, '403 Forbidde');
        $checkVendedor = $this->ticketPertenceAoVendedor();
        $checkCliente = $this->ticketPertenceAoCliente();
        abort_if(empty($checkVendedor || $checkCliente) || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $replica = Replica::create($request->validated());
        return redirect()->route('replicaCreate', ['replicaId' => $request->ticket_id]);
    }
}
