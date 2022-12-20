<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_Payment extends Model
{
    use HasFactory;
    protected $table = 'patient_payment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable=
    ['patient_id',
     'payment_id',];
}
