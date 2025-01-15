<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Client;
use App\Models\User;

class CashLoan extends Model
{
    use HasFactory;

    protected $fillable = ['loan_amount', 'client_id', 'user_id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function advisor():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
