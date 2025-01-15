<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;
use App\Models\CashLoan;
use App\Models\HomeLoan;

class ProductService
{
    /**
     * Create Cash Loan Application instance
     *
     * @param array $data
     * @param Client $client
     * @param User $advisor
     * @return CashLoan
     */
    public function createCashLoanInstance(array $data, Client $client, User $advisor): void
    {
        $cashLoan = $client->cashLoan;

        //Since it's not defined if 0 value means set or delete,
        //and there's no other way to delete loan to be testable y/n on board
        //i added this check, which could be consider purely optional and turned off
        if((float)$data['loan_amount'] === 0.00 && $cashLoan !== null)
        {        
            $cashLoan->delete();
        }
        //Try to update Cash Loan
        else if($cashLoan !== null && $cashLoan->loan_amount !== (float)$data['loan_amount'])
        {
            //Advisor can update only products he made for user
            if(auth()->user()->id === $client->cashLoan->user_id)
            {
                //Update Cash Loan
                $cashLoan->loan_amount = $data['loan_amount'];
                $cashLoan->save();
            }
        }
        else if($cashLoan === null && (float)$data['loan_amount'] !== 0.00)
        {
            //Make new Cash Loan if Client doesn't have one
            \App\Models\CashLoan::create([
                'user_id' => $advisor->id,
                'client_id' => $client->id,
                'loan_amount' => $data['loan_amount']
            ]);
        }
    }

    /**
     * Create Home Loan Application instance
     *
     * @param array $data
     * @param Client $client
     * @param User $advisor
     * @return HomeLoan
     */
    public function createHomeLoanInstance(array $data, Client $client, User $advisor): void
    {
        $homeLoan = $client->homeLoan;

        //Since it's not defined if 0 value means set or delete,
        //and there's no other way to delete loan to be testable y/n on board
        //i added this check, which could be consider purely optional and turned off
        if((float)$data['property_value'] === 0.00 && (float)$data['down_payment_amount'] === 0.00 && $homeLoan !== null)
        {
            $homeLoan->delete();
        }
        //Try to update Home Loan
        else if($homeLoan !== null && ($homeLoan->property_value !== (float)$data['property_value'] || $homeLoan->down_payment_amount !== (float)$data['down_payment_amount']))
        {
            //Advisor can update only products he made for user
            if(auth()->user()->id === $client->homeLoan->user_id)
            {
                //Update Home Loan
                $homeLoan->update([
                    'property_value' => $data['property_value'],
                    'down_payment_amount' => $data['down_payment_amount']
                ]);
            }
        }
        else if($homeLoan === null && ((float)$data['property_value'] !== 0.00 || (float)$data['property_value'] !== 0.00))
        {
            //Make new Home Loan if Client doesn't have one
            \App\Models\HomeLoan::create([
                'user_id' => $advisor->id,
                'client_id' => $client->id,
                'property_value' => $data['property_value'],
                'down_payment_amount' => $data['down_payment_amount'],
            ]);
        }
    }

    /**
     * Generate organized all loan products array
     *
     * @return array
     */
    public function buildProductsArray(): array
    {
        //Get only current logged in advisor assigned products
        $cashLoans = CashLoan::with('advisor', 'client')->where('user_id', auth()->user()->id)->get();
        $homeLoans = HomeLoan::with('advisor', 'client')->where('user_id', auth()->user()->id)->get();

        //Loop and organize all loans
        $allLoans = [];
        foreach ($cashLoans as $loan) {
            $allLoans[] = [
                'product_type' => 'Cash loan',
                'product_value' => $loan->loan_amount,
                'creation_date' => $loan->created_at,
            ];
        }
        foreach ($homeLoans as $loan) {
            $allLoans[] = [
                'product_type' => 'Home loan',
                'product_value' => $loan->property_value - $loan->down_payment_amount,
                'creation_date' => $loan->created_at,
            ];
        }

        //Sort by creation date from newest to oldest
        usort($allLoans, function ($a, $b) {
            return strtotime($b['creation_date']) - strtotime($a['creation_date']);
        });

        return $allLoans;
    }

}
