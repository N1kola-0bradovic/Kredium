<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CashLoan;
use App\Models\HomeLoan;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): View
    {
        $allLoans = $this->productService->buildProductsArray();
        return view('report', compact('allLoans'));
    }

    public function export(): StreamedResponse
    {
        //Generate structurized products array
        $allLoans = $this->productService->buildProductsArray();

        //Set the filename
        $filename = 'loans_' . date('Ymd_His') . '.csv';

        //Set headers for the response
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        //Open output stream
        $handle = fopen('php://output', 'w');

        //Add the header row
        fputcsv($handle, ['Product Type', 'Product Value', 'Creation Date']);

        //Add data rows
        foreach ($allLoans as $loan) {
            fputcsv($handle, $loan);
        }

        //Close the output stream
        fclose($handle);
        
        //Return a response
        return response()->stream(function () use ($handle) {}, 200);
    }

}
