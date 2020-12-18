<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function scopeSearch($query, $search)
    {
        $query->where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('nick_name', 'LIKE', '%' . $search . '%')
            ->orWhere('contact_number', 'LIKE', '%' . $search . '%');
    }
    
    public function scopeWbalance($query)
    {
        $query->where('current_balance', '>', 0);
    }
}
