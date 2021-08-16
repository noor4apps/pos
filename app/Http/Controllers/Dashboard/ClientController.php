<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_clients'])->only(['index']);
        $this->middleware(['permission:create_clients'])->only(['create', 'store']);
        $this->middleware(['permission:update_clients'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_clients'])->only(['destroy']);
    }// end of construct

    public function index(Request $request)
    {
        $clients = Client::paginate(5);
        return view('dashboard.clients.index', compact('clients'));
    } // end of index

    public function create()
    {
        return view('dashboard.clients.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone.0' => 'required|regex:/(09)[0-9]{8}/',
            'phone.1' => 'nullable|regex:/[0-9]{3}[0-9]{7}/',
            'address' => 'required',
        ]);

        Client::create($request->all());

        return redirect()->route('dashboard.clients.index')->with('success', __('site.added_successfully'));

    } // end of store

    public function edit( Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    } // end of edit

    public function update(Request $request, Client $client)
    {

    } // end of update

    public function destroy(Client $client)
    {

    } // end of destroy

} // end of controller
