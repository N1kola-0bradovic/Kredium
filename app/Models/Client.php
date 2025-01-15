<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\CashLoan;
use App\Models\HomeLoan;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email'];

    protected $appends = ['home_loan_tag', 'cash_loan_tag'];

    public function getHomeLoanTagAttribute(): bool
    {
        return ($this->homeLoan !== null) ? 1 : 0;
    }

    public function getCashLoanTagAttribute(): bool
    {
        return ($this->cashLoan !== null) ? 1 : 0;
    }

    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }

    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }
}
