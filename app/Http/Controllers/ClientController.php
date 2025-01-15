<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Http\Requests\StoreContactRequest;
use App\Services\ProductService;
use Illuminate\View\View;
use App\Models\Client;

class ClientController extends Controller
{
    protected $clientRepo;
    protected $productService;

    public function __construct(ClientRepositoryInterface $clientRepo, ProductService $productService)
    {
        $this->clientRepo = $clientRepo;
        $this->productService = $productService;
    }

    public function index(): View
    {        
        $clients = $this->clientRepo->all();
        return view('client', compact('clients'));
    }

    public function create(): View
    {
        return view('client-create');
    }

    public function store(StoreContactRequest $request): View
    {
        $client = $this->clientRepo->create($request->all());
        session()->flash('successMsg', 'Client is created!');
        return view('client-create');
    }

    // public function show($id)
    // {
    //     $client = $this->clientRepo->find($id);
    //     return response()->json($client);
    // }

    public function edit(Client $client): View
    {
        $client = $this->clientRepo->find($client);
        return view('client-edit', compact('client'));
    }

    public function update(StoreContactRequest $request, Client $client): View
    {
        $client = $this->clientRepo->update($client, $request->all());

        //Cash Loan Apply
        $this->productService->createCashLoanInstance($request->input(), $client, auth()->user());

        //Home Loan Apply
        $this->productService->createHomeLoanInstance($request->input(), $client, auth()->user());

        session()->flash('successMsg', 'Client is edited!');
        return view('client-create');
    }

    public function destroy(Client $client): View
    {
        $this->clientRepo->delete($client);
        
        //Refresh Dashboard
        $clients = $this->clientRepo->all();
        return view('client', compact('clients'));
    }
}
