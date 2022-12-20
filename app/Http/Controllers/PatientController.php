<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\PatientDataTable;
use App\Models\Appointment;
use App\Models\Appointment_Patient;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(PatientDataTable $dataTable)
    {
        return $dataTable->render('patient.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        if($request->ajax()){
        return view('patient.addPatientFast')->render();
    } 
    else
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        if(!($request->ajax())){
        $request->validate([
            'firstname'=>'required|max:15|min:3',
            'lastname'=>'required|max:15|min:3',
            
        ]);

        

        $patient= new Patient;
        $patient->firstname=$request->input('firstname');
        $patient->midname=$request->input('midname');
        $patient->lastname=$request->input('lastname');
        $patient->dob=$request->input('dob');
        $patient->insurance=$request->input('insurancetype');
        $patient->gender=$request->input('gender');
        $patient->bloodtype=$request->input('bloodtype');
        $patient->diag=$request->input('diag');
        $patient->job=$request->input('job');
        $patient->address=$request->input('address');
        $patient->number=$request->input('number');
        $patient->maincomplaint=$request->input('maincomplaint');
        
        // now eyes' deatails

        //OD
        $patient->OD_VA=$request->input('OD_VA');
        $patient->OD_AUTO=$request->input('OD_AUTO');
        $patient->OD_BCVA_FAR=$request->input('OD_BCVA_FAR');
        $patient->OD_NEAR=$request->input('OD_NEAR');
        $patient->OD_AUTO_AFTER_CYCLO=$request->input('OD_AUTO_AFTER_CYCLO');
        $patient->OD_BUT=$request->input('OD_BUT');
        $patient->OD_IOP=$request->input('OD_IOP');
        $patient->OD_LIDS=$request->input('OD_LIDS');
        $patient->OD_CORNEA=$request->input('OD_CORNEA');
        $patient->OD_CONJUNCTIVA=$request->input('OD_CONJUNCTIVA');
        $patient->OD_IRIS=$request->input('OD_IRIS');
        $patient->OD_AC=$request->input('OD_AC');
        $patient->OD_LENS=$request->input('OD_LENS');
        $patient->OD_VITREOUS=$request->input('OD_VITREOUS');
        $patient->OD_CD=$request->input('OD_CD');
        $patient->OD_FUNDUS=$request->input('OD_FUNDUS');

        //OS
        $patient->OS_VA=$request->input('OS_VA');
        $patient->OS_AUTO=$request->input('OS_AUTO');
        $patient->OS_BCVA_FAR=$request->input('OS_BCVA_FAR');
        $patient->OS_NEAR=$request->input('OS_NEAR');
        $patient->OS_AUTO_AFTER_CYCLO=$request->input('OS_AUTO_AFTER_CYCLO');
        $patient->OS_BUT=$request->input('OS_BUT');
        $patient->OS_IOP=$request->input('OS_IOP');
        $patient->OS_LIDS=$request->input('OS_LIDS');
        $patient->OS_CORNEA=$request->input('OS_CORNEA');
        $patient->OS_CONJUNCTIVA=$request->input('OS_CONJUNCTIVA');
        $patient->OS_IRIS=$request->input('OS_IRIS');
        $patient->OS_AC=$request->input('OS_AC');
        $patient->OS_LENS=$request->input('OS_LENS');
        $patient->OS_VITREOUS=$request->input('OS_VITREOUS');
        $patient->OS_CD=$request->input('OS_CD');
        $patient->OS_FUNDUS=$request->input('OS_FUNDUS');
        
        // Ended here



        
        
        if($patient->save())
        return back()->with( 'success',__('lang.Addsuccess'));
        else
        return back()->with( 'failed',__('lang.Addfailed'));
    }
    else{
        $validator = Validator::make($request->all(), [
            'firstname'=>'required|max:15|min:3',
            'lastname'=>'required|max:15|min:3',
           

        ]);

        if ($validator->validated()) {
        $data=$request->all();
        $patient= new Patient;
        $patient->firstname=$data['firstname'];
        $patient->midname=$data['midname'];
        $patient->lastname=$data['lastname'];
        $patient->dob=$data['dob'];
        $patient->insurance=$data['insurancetype'];
        $patient->gender=$data['gender'];
        $patient->bloodtype=$data['bloodtype'];
        $patient->diag=$data['diag'];
        $patient->job=$data['job'];
        $patient->address=$data['address'];
        $patient->number=$data['number'];
        $patient->maincomplaint=$data['maincomplaint'];
        if($patient->save()){
            if(isset($data['withAppointment']))
            {
               
            $appointment = new Appointment();
            $appointment->date = Carbon::now()->format('Y-m-d');
            $appointment->save();
            
            //saving appointment end
            $Appointment_Patient = new Appointment_Patient();
            $Appointment_Patient->appointment_id = $appointment->id;
            $Appointment_Patient->patient_id = $patient->id;
            $Appointment_Patient->save();
            }
            return response()->json(['success'=>'Added new Patient.']);
        }
        else{
            return response()->json(['failed'=>'Faled to add new Patient.']);
        }
        
        
        // Ended here



    }
    return response()->json(['error'=>$validator->errors()]);


    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient=Patient::find($id);
        $patientPayments=Patient::where('id',$id)->with('payment')->get();
        return view('patient.show',compact('patient','patientPayments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient=Patient::find($id);
        return view('patient.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Patient::where('id', $id)->update([
            'firstname'=>$request->input('firstname'),
            'midname'=>$request->input('midname'),
            'lastname'=>$request->input('lastname'),
            'dob'=>$request->input('dob'),
            'insurance'=>$request->input('insurancetype'),
            'gender'=>$request->input('gender'),
            'bloodtype'=>$request->input('bloodtype'),
            'diag'=>$request->input('diag'),
            'job'=>$request->input('job'),
            'address'=>$request->input('address'),
            'number'=>$request->input('number'),
            'maincomplaint'=>$request->input('maincomplaint'),


            // now eyes' deatails

            //OD
            'OD_VA'=>$request->input('OD_VA'),
            'OD_AUTO'=>$request->input('OD_AUTO'),
            'OD_BCVA_FAR'=>$request->input('OD_BCVA_FAR'),
            'OD_NEAR'=>$request->input('OD_NEAR'),
            'OD_AUTO_AFTER_CYCLO'=>$request->input('OD_AUTO_AFTER_CYCLO'),
            'OD_BUT'=>$request->input('OD_BUT'),
            'OD_IOP'=>$request->input('OD_IOP'),
            'OD_LIDS'=>$request->input('OD_LIDS'),
            'OD_CORNEA'=>$request->input('OD_CORNEA'),
            'OD_CONJUNCTIVA'=>$request->input('OD_CONJUNCTIVA'),
            'OD_IRIS'=>$request->input('OD_IRIS'),
            'OD_AC'=>$request->input('OD_AC'),
            'OD_LENS'=>$request->input('OD_LENS'),
            'OD_VITREOUS'=>$request->input('OD_VITREOUS'),
            'OD_CD'=>$request->input('OD_CD'),
            'OD_FUNDUS'=>$request->input('OD_FUNDUS'),

            //OS
            'OS_VA'=>$request->input('OS_VA'),
            'OS_AUTO'=>$request->input('OS_AUTO'),
            'OS_BCVA_FAR'=>$request->input('OS_BCVA_FAR'),
            'OS_NEAR'=>$request->input('OS_NEAR'),
            'OS_AUTO_AFTER_CYCLO'=>$request->input('OS_AUTO_AFTER_CYCLO'),
            'OS_BUT'=>$request->input('OS_BUT'),
            'OS_IOP'=>$request->input('OS_IOP'),
            'OS_LIDS'=>$request->input('OS_LIDS'),
            'OS_CORNEA'=>$request->input('OS_CORNEA'),
            'OS_CONJUNCTIVA'=>$request->input('OS_CONJUNCTIVA'),
            'OS_IRIS'=>$request->input('OS_IRIS'),
            'OS_AC'=>$request->input('OS_AC'),
            'OS_LENS'=>$request->input('OS_LENS'),
            'OS_VITREOUS'=>$request->input('OS_VITREOUS'),
            'OS_CD'=>$request->input('OS_CD'),
            'OS_FUNDUS'=>$request->input('OS_FUNDUS'),

            

        ])) 
            return back()->with( 'success',__('lang.Updatesuccess'));
            else
            return back()->with( 'failed',__('lang.Updatefailed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient=Patient::find($id);
        if($patient->delete())
        return back()->with('success',"Deleted Successfully");
        else 
        return back()->with('failed',"Failed to Delete");
    }
}
