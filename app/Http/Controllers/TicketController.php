<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Payment;
use App\Models\Evenement;


class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if ($this->isAdmin()) {
            // For admin, retrieve all tickets from the database
            $tickets = Ticket::all();
            return view('pages.Ticket.index', compact('tickets'));
        } else {
            // For users, retrieve only their own tickets (adjust this part according to your user role logic)
            $tickets = Ticket::all();

            return view('pages.Ticket.indexuser', compact('tickets'));
        }

    }
    // public function index_admin() {
    //     $tickets = Ticket::all();

    //     return view('pages.Ticket.index', compact('tickets'));


    // }
    /** Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role === 'admin') {
            $payments = Payment::all();
            $evenements = Evenement::all();

            return view('pages.Ticket.create', compact('payments','evenements'));
        } else {
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $request->validate([
                'name_ticket' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
                'type' => 'required',
                'ref_ticket' => 'required|unique:tickets|starts_with:ref-',
                'description' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/',
                'amount' => 'required|numeric|min:0',
            ]);
            // $ticket->payment()->associate($request->input('payment_id'));


            $ticket = Ticket::create($request->all());

            return redirect()->route('tickets.index');
        } else {
            return redirect()->back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role === 'admin') {
            $payments = Payment::all();
            $evenements = Evenement::all();
            $ticket = Ticket::find($id);

            return view('pages.Ticket.edit', compact('ticket', 'payments', 'evenements'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'admin') {
            $ticket = Ticket::find($id);
            $request->validate([
                'name_ticket' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
                'type' => 'required',
                'ref_ticket' => 'required|unique:tickets|starts_with:ref-',
                'description' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/',
                'amount' => 'required|numeric|min:0',
            ]);

            $ticket->amount = $request->amount;
            $ticket->name_ticket = $request->name_ticket;
            $ticket->type = $request->type;
            $ticket->description = $request->description;
            $ticket->ref_ticket = $request->ref_ticket;

            $ticket->save();

            return redirect()->route('tickets.index')
                ->with('success', 'Ticket has Been updated successfully');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //$product = Product::find($id) ;
        return view('pages.Ticket.show', compact('ticket'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role === 'admin') {
            $ticket = Ticket::find($id);
            $ticket->delete();
            return redirect()->route('tickets.index')
                ->with('success', 'Ticket deleted successfully');
        } else {
            return redirect()->back();
        }
    }


    private function isAdmin()
    {
        // Check if the authenticated user's 'role' attribute is 'admin'
        return auth()->user()->role === 'admin';
    }
    
    

}
