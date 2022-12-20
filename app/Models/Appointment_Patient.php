<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_Patient extends Model
{
    use HasFactory;
    protected $table = 'appointment_patient';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable=
    ['appointment_id',
     'patient_id',];
}
