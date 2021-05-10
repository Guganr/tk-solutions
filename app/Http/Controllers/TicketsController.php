<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Replica;
use App\Models\Ticket;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use Spatie\QueryBuilder\QueryBuilder;

class TicketsController extends Controller {

    public function index() {
        abort_if(Gate::clienteVendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tickets = '';
        if (auth()->user()->getUserRole()->get()[0]->id == 2) {
            $tickets = $this->ticketsCliente();
        } else {
            $tickets =
            QueryBuilder::for(Ticket::class)
                ->allowedFilters('status')
                ->paginate(10);
        }
        return view('tickets.index', compact('tickets'));
    }
    public function create() {      
        abort_if(Gate::cliente(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tickets.create');
    }

    public function store(StoreTicketRequest $request) {
        abort_if(Gate::cliente(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ticket = new Ticket();
        $ticket->user_id = auth()->user()->id;
        $ticket->status = $request->status;
        $ticket->mensagem = $request->mensagem;
        $ticket->save();
        return view('tickets.show', compact('ticket'));
    }

    public function show($id) {
        abort_if(Gate::clienteVendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $checkVendedor = $this->ticketPertenceAoVendedor();
        $checkCliente = $this->ticketPertenceAoCliente();
        abort_if(empty($checkVendedor || $checkCliente) || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ticket = Ticket::find($id);
        $replicas = Replica::where('ticket_id', $id)->get();
        $ticket->load('replicas');
        return view('tickets.show', compact(["ticket", 'replicas']));
    }

    public function update(UpdateTicketRequest $request, $id) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ticket = [
            "responsavel" => $request->responsavel,
            "status" => $request->status,
        ];
        Ticket::where('id', $request->id)->update($ticket);
        return redirect()->route('tickets.index');
    }
}
