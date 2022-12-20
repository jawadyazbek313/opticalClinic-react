<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    public $timestamps = true;


    protected $fillable = [
        'date',
        'time',
        'isDone',
        'notes',
        'dist_r_sphere',
        'dist_r_cylinder',
        'dist_r_axis',
        'near_r_sphere',
        'near_r_cylinder',
        'near_r_axis',
        'dist_l_sphere',
        'dist_l_cylinder',
        'dist_l_axis',
        'near_l_sphere',
        'near_l_cylinder',
        'near_l_axis',
        'pddist',
        'trashed',
        'pdnear'
    
    ];

    function relations() {
        return $this->hasMany(Relation::class);
     }

     function patient() {
        return $this->belongsToMany(Patient::class, 'appointment_patient', 'appointment_id', 'patient_id');
     }
     function payment(){
        return $this->belongsToMany(Payment::class);
     }
}
