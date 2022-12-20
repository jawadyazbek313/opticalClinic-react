<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;

class Relation extends Controller
{
    function patient() {
        return $this->belongsToMany(Patient::class);
     }
     
     function payment() {
        return $this->belongsToMany(Payment::class);
     }
     
     function appointment() {
        return $this->belongsToMany(Appointment::class);
     }
}
