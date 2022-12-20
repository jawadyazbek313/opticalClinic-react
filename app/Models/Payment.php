<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    
    protected $table = 'payments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'payment_type',
        'payment',
        'payment_currency',
        
    ];

    function relations() {
        return $this->hasMany(Relation::class);
     }

}
