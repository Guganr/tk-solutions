<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplicaRequest;
use App\Models\Replica;
use App\Models\Ticket;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ReplicasController extends Controller {
    
    public function create($id) {
        $checkCliente = $this->ticketPertenceAoCliente($id);
        abort_if(empty($checkCliente->all()) && Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ticket = Ticket::find($id);
        $replicas = Replica::where('ticket_id', $id)->get();
        $ticket->load('replicas');
        $uploads = $ticket->uploads();
        $upload = $uploads->all();
        return view('replicas.create', compact(["ticket", 'replicas', 'upload']));
    }

    public function store(StoreReplicaRequest $request) {
        abort_if(Gate::clienteVendedor() , Response::HTTP_FORBIDDEN, '403 Forbidde');
        $replica = Replica::create($request->validated());
        $request->validate([
            'file_upload_replica' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->entidade = 'replica_id';
        $this->upload($request, 'upload_replica', 'file_upload_replica', $replica->id);
        return redirect()->route('replicaCreate', ['replicaId' => $request->ticket_id]);
    }

}
