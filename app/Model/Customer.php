<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    protected $fillable = [
        'first_name', 'last_name', 'nick_name', 'contact_number', 'contact_address', 'barangay', 'landmark', 'current_balance'
    ];
    
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
    
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }
    
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }
    
    public function setNickNameAttribute($value)
    {
        $this->attributes['nick_name'] = strtoupper($value);
    }
    
    public function setContactNumberAttribute($value)
    {
        $this->attributes['contact_number'] = strtoupper($value);
    }
    
    public function setContactAddressAttribute($value)
    {
        $this->attributes['contact_address'] = strtoupper($value);
    }
    
    public function setBarangayAttribute($value)
    {
        $this->attributes['barangay'] = strtoupper($value);
    }
    
    public function setLandmarkAttribute($value)
    {
        $this->attributes['landmark'] = strtoupper($value);
    }
    
}
