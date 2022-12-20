<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_Payment extends Model
{
    use HasFactory;
    protected $table = 'appointment_payment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable=
    ['appointment_id',
     'payment_id',];
}
