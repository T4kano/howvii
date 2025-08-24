<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['property_id', 'customer_id', 'paid_at', 'amount'];
    protected $casts = ['paid_at' => 'date'];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
