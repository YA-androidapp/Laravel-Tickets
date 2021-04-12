<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $keyword = $request->input('keyword');
        $keyword = str_replace(array(' ', '%20', '+'), ' ', $keyword);
        $k = explode(' ', $keyword);
        if (count($k) === 2) {
            $k_id = $k[0];
            $k_uuid = $k[1];
            $query = Ticket::query();
            $query->where('id', '=', "{$k_id}")
                ->Where('uuid', '=', "{$k_uuid}");
            $tickets = $query->paginate();
            return view('ticket.index', compact('tickets'))->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
        } elseif ($keyword !== '') {
            $query = Ticket::query();
            $query->where('id', '=', "");
            $tickets = $query->paginate();
            return view('ticket.index', compact('tickets'))->with('i', 0);
        } else {
            $tickets = Ticket::paginate();

            return view('ticket.index', compact('tickets'))
                ->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = new Ticket();
        return view('ticket.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ticket::$rules);

        $ticket = Ticket::create($request->all());

        return view('ticket.show', compact('ticket'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);

        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        request()->validate(Ticket::$rules);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id)->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully');
    }
}
