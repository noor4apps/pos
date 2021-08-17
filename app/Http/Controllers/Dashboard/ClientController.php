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
        $clients = Client::when($request->search, function ($q) use ($request){

            return $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);
        return view('dashboard.clients.index', compact('clients'));

    } // end of index

    public function create()
    {
        return view('dashboard.clients.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:clients',
            'phone.0' => 'required|regex:/(09)[0-9]{8}/',
            'phone.1' => 'nullable|regex:/[0-9]{3}[0-9]{7}/',
            'address' => 'required',
        ]);

        $data = $request->all();
        // clean phone from null if phone.1 is null
//        $data['phone'] = array_filter($request->phone);

        Client::create($data);

        return redirect()->route('dashboard.clients.index')->with('success', __('site.added_successfully'));

    } // end of store

    public function edit( Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    } // end of edit

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|unique:clients,name,' . $client->id,
            'phone.0' => 'required|regex:/(09)[0-9]{8}/',
            'phone.1' => 'nullable|regex:/[0-9]{3}[0-9]{7}/',
            'address' => 'required',
        ]);

        $data = $request->all();
        // clean phone from null if phone.1 is null
//        $data['phone'] = array_filter($request->phone);

        $client->update($data);

        return redirect()->route('dashboard.clients.index')->with('success', __('site.updated_successfully'));

    } // end of update

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('dashboard.clients.index')->with('success', __('site.deleted_successfully'));

    } // end of destroy

} // end of controller
