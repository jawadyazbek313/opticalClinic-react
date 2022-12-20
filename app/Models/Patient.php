<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Patient extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $table = 'patients';
    protected $primaryKey = 'id';
    public $timestamps = true;



    protected $fillable = [
        'id',
        'firstname',
        'midname',
        'lastname',
        'dob',
        'insurance',
        'gender',
        'bloodtype',
        'diag',
        'job',
        'address',
        'number',
        'maincomplaint',
        'pathological_story',
        'OD_VA',
        'OD_AUTO',
        'OD_BCVA_FAR',
        'OD_NEAR',
        'OD_AUTO_AFTER_CYCLO',
        'OD_BUT',
        'OD_IOP',
        'OD_LIDS',
        'OD_CORNEA',
        'OD_CONJUNCTIVA',
        'OD_IRIS',
        'OD_AC',
        'OD_LENS',
        'OD_VITREOUS',
        'OD_CD',
        'OD_FUNDUS',
        'OS_VA',
        'OS_AUTO',
        'OS_BCVA_FAR',
        'OS_NEAR',
        'OS_AUTO_AFTER_CYCLO',
        'OS_BUT',
        'OS_IOP',
        'OS_LIDS',
        'OS_CORNEA',
        'OS_CONJUNCTIVA',
        'OS_IRIS',
        'OS_AC',
        'OS_LENS',
        'OS_VITREOUS',
        'OS_CD',
        'OS_FUNDUS'
    ];


    public function getIDandFullnameAttribute()
    {
        return [
            'id' => $this->id,
            'fullname' => $this->firstname . ' ' . $this->midname . ' ' . $this->lastname
        ];
    }


    function relations()
    {
        return $this->hasMany(Relation::class);
    }

    function appointment()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_patient', 'patient_id', 'appointment_id');
    }

    function payment()
    {
        return $this->belongsToMany(Payment::class, 'patient_payment', 'patient_id', 'payment_id');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    function MediaManually()
    {
        return $this->hasMany(Media::class, 'model_id', 'id')->where('model_type', 'App\Models\Patient');
    }
}
