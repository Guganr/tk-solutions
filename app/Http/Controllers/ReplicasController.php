<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplicaRequest;
use App\Models\Replica;
use App\Models\Ticket;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;

class ReplicasController extends Controller {
    
    public function create($id) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidde');
        $ticket = Ticket::find($id);
        $replicas = Replica::where('ticket_id', $id)->get();
        $ticket->load('replicas');
        return view('replicas.create', compact(["ticket", 'replicas']));
    }

    public function store(StoreReplicaRequest $request) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidde');
        $replica = Replica::create($request->validated());
        return redirect()->route('replicaCreate', ['replicaId' => $request->ticket_id]);
    }
}
