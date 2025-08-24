<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'property_type_id'];


    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
