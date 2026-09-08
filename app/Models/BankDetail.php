<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'user_id',
        'bank_account_no',
        'bank_name',
        'bank_holder_name',
        'swift',
        'ifsc',
        'paypal_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
