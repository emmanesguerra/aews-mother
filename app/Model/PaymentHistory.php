<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'customer_id', 'old_balance', 'pay_amount', 'new_balance', 'can_cancel', 'date_canceled'
    ];
    
    protected $dates  = [
        'date_canceled'
    ];
    
    public function scopeNotCanceled($query)
    {
        $query->whereNull('date_canceled');
    }
    
    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
