<?php

namespace App\Http\Controllers;

use App\Models\MasterTicketing;
use Illuminate\Http\Request;

class MasterTicketingController extends Controller
{
    public function index()
    {
        return view('ticketing.index');
    }

    public function dataTable()
    {
        $data = MasterTicketing::all()->map(fn($t) => [
            'id'            => $t->id,
            'ticket_number' => $t->ticket_number,
            'ticket_type'   => $t->ticket_type,
            'subject'       => $t->subject,
            'description'   => $t->description,
            'created_at'    => $t->created_at?->format('d M Y'),
        ]);
        return response()->json(['data' => $data]);
    }

    public function create()
    {
        return view('ticketing.form', ['ticket' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|string|max:50|unique:master_ticketing,ticket_number',
            'ticket_type'   => 'required|in:PRPK,MEMO',
            'subject'       => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        MasterTicketing::create([
            ...$request->only('ticket_number', 'ticket_type', 'subject', 'description'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('ticketing.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit(MasterTicketing $ticketing)
    {
        return view('ticketing.form', ['ticket' => $ticketing]);
    }

    public function update(Request $request, MasterTicketing $ticketing)
    {
        $request->validate([
            'ticket_number' => 'required|string|max:50|unique:master_ticketing,ticket_number,' . $ticketing->id,
            'ticket_type'   => 'required|in:PRPK,MEMO',
            'subject'       => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $ticketing->update([
            ...$request->only('ticket_number', 'ticket_type', 'subject', 'description'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('ticketing.index')->with('success', 'Tiket berhasil diupdate.');
    }

    public function destroy(MasterTicketing $ticketing)
    {
        $ticketing->delete();
        return back()->with('success', 'Tiket berhasil dihapus.');
    }
}
