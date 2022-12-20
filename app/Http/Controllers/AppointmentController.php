<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\Appointment_Payment;
use App\Models\Appointment_Patient;
use App\Models\Patient_Payment;
use Illuminate\Http\Request;
use App\DataTables\AppointmentDataTable;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function trashlistrefresh(){
    
        $appointments=Appointment::where('trashed', 1)->orderBy('updated_at','DESC')->with('patient:id,firstname,midname,lastname')->paginate(7);
        return view('appointment.trashlistAjax',compact('appointments'))->render();
         
        
        
    
    }

    public function trashlist(Request $request){
    
        $appointments=Appointment::where('trashed', 1)->orderBy('updated_at','DESC')->with('patient:id,firstname,midname,lastname')->paginate(7);
        return view('appointment.trashlist',compact('appointments'));
    
    }


    public function restore($id){
        if(auth()->user()){
        $app=Appointment::where('id',$id)->get()->last();
        if($app->trashed==1){
            Appointment::where('id', $id)->update([
                'trashed' => 0,
            ]);
            return response()->json(['success' => __('lang.RestoringSuccess')]);

        }    
        }
    }
    
    public function trash(Request $request){
        if(!empty($request->appointment_id)){
            if($request->type=='temp'){
                Appointment::where('id', $request->appointment_id)->update([
                    'trashed' => 1,
                ]);

                return response()->json(['success' => __('lang.TrashingSuccess')]);
            
            }
            else if($request->type=='perm'){
                $app=Appointment::where('id',$request->appointment_id);
                $app->delete();
                return response()->json(['success' => __('lang.Deletesuccess')]);
            }
        }
    }

    public function index(AppointmentDataTable $dataTable)
    {
        $appointments = Appointment::select('id', 'date', 'time', 'isDone', 'notes')->orderBy('date', 'DESC')->where('trashed',0)->orderBy('time', 'ASC')->with('patient:id,firstname,midname,lastname')->with('payment')->paginate(10);

        return view('appointment.index')->with('appointments', $appointments);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $patients = Patient::select('id', 'firstname', 'midname', 'lastname', 'dob')->get();
            return view('appointment.createInModal')->with('patients', $patients)->render();
        } else {
            $patients = Patient::select('id', 'firstname', 'midname', 'lastname', 'dob')->get();
            return view('appointment.create')->with('patients', $patients);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->ajax()) {
            $data=$request->all();

            $appointment = new Appointment;
            $appointment->date = $data['date'];
            $appointment->time = $data['time'];
            $appointment->isDone = $data['isDone'];
            $appointment->notes = $data['notes'];
            $appointment->save();
            $appointment = Appointment::all()->last();
            //saving appointment end
            $patient = new Appointment_Patient;
            $patient->appointment_id = $appointment->id;
            $patient->patient_id = $data['patient_id'];
            $patient->save();
            //saving pivot 1 end    
            if ($request->input('isDone') == '1') {

                $payment = new Payment;
                $payment->payment_type = $request->input('payment_type');
                if ($request->input('payment_type') == 'cash') {
                    $payment->payment_currency = $request->input('payment_currency');
                }
                $payment->payment = $request->input('payment');
                $payment->save();

                $payment = Payment::all()->last();
                $patient = new Patient_Payment;
                $patient->patient_id = $request->input('patient_id');
                $patient->payment_id = $payment->id;
                $patient->save();
                $pivot = new Appointment_Payment;
                $pivot->appointment_id = $appointment->id;
                $pivot->payment_id = $payment->id;
                $pivot->save();
                // saving pivot 2 end
            

            }return response()->json(['success' => __('lang.AppointmentAdded')]);
        } else {
            $request->validate([
                'patient_id' => 'required',
                'date' => 'required',


            ]);

            $appointment = new Appointment;
            $appointment->date = $request->input('date');
            $appointment->time = $request->input('time');
            $appointment->isDone = $request->input('isDone');
            $appointment->notes = $request->input('notes');
            $appointment->dist_r_sphere = $request->input('dist_r_sphere');
            $appointment->dist_l_sphere = $request->input('dist_l_sphere');
            $appointment->dist_r_cylinder = $request->input('dist_r_cylinder');
            $appointment->dist_l_cylinder = $request->input('dist_l_cylinder');
            $appointment->dist_r_axis = $request->input('dist_r_axis');
            $appointment->dist_l_axis = $request->input('dist_l_axis');
            $appointment->near_r_sphere = $request->input('near_r_sphere');
            $appointment->near_l_sphere = $request->input('near_l_sphere');
            $appointment->near_r_cylinder = $request->input('near_r_cylinder');
            $appointment->near_l_cylinder = $request->input('near_l_cylinder');
            $appointment->near_r_axis = $request->input('near_r_axis');
            $appointment->near_l_axis = $request->input('near_l_axis');
            $appointment->pddist = $request->input('pddist');
            $appointment->pdnear = $request->input('pdnear');
            $appointment->save();
            $appointment = Appointment::all()->last();

            $patient = new Appointment_Patient;
            $patient->appointment_id = $appointment->id;
            $patient->patient_id = $request->input('patient_id');
            if (!$patient->save()) return "WTF";
            if ($request->input('isDone') == '1') {

                $payment = new Payment;
                $payment->payment_type = $request->input('payment_type');
                if ($request->input('payment_type') == 'cash') {
                    $payment->payment_currency = $request->input('payment_currency');
                }
                $payment->payment = $request->input('payment');
                $payment->save();

                $payment = Payment::all()->last();
                $patient = new Patient_Payment;
                $patient->patient_id = $request->input('patient_id');
                $patient->payment_id = $payment->id;
                $patient->save();
                $pivot = new Appointment_Payment;
                $pivot->appointment_id = $appointment->id;
                $pivot->payment_id = $payment->id;
                $pivot->save();
            }


            return back()->with('success', __('lang.Addsuccess'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            $appointment = Appointment::where('id', $id)->with('patient:id,firstname,midname,lastname')->with('payment')->get()->last();
            return view('appointment.showInModal', compact('appointment'))->render();
        } else {
            $appointment = Appointment::where('id', $id)->with('patient:id,firstname,midname,lastname')->with('payment')->get()->last();

            return view('appointment.show', compact('appointment'));
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
            $appointment = Appointment::where('id', $id)->with('patient:id,firstname,midname,lastname')->with('payment')->get()->last();
            $patients = Patient::select('id', 'firstname', 'midname', 'lastname', 'dob')->get();

            return view('appointment.editInModal', compact('appointment', 'patients'))->render();
        } else {
            $appointment = Appointment::where('id', $id)->with('patient:id,firstname,midname,lastname')->with('payment')->get()->last();
            $patients = Patient::select('id', 'firstname', 'midname', 'lastname', 'dob')->get();

            return view('appointment.edit', compact('appointment', 'patients'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        if($request->input('isDone')==0){
            $app_pay=Appointment_Payment::where('appointment_id',$id)->get();
            if(count($app_pay)==1){
                $payment=Payment::find($app_pay[0]->payment_id);
                $payment->delete();
            }
            
        }
        if($request->input('isDone')==1){
            $app_pay=Appointment_Payment::where('appointment_id',$id)->get()->last();
            
            if(!($app_pay)){
                $appointment=Appointment_Patient::where('appointment_id',$id)->get();
                $payment = new Payment;
                $payment->payment_type = $request->input('payment_type');
                if ($request->input('payment_type') == 'cash') {
                    $payment->payment_currency = $request->input('payment_currency');
                }
                $payment->payment = $request->input('payment');
                $payment->save();

                $payment = Payment::all()->last();
                $patient = new Patient_Payment;
                $patient->patient_id = $appointment[0]->patient_id;
                $patient->payment_id = $payment->id;
                $patient->save();
                $pivot = new Appointment_Payment;
                $pivot->appointment_id = $id;
                $pivot->payment_id = $payment->id;
                $pivot->save();

            }
            }
            $app_pay=Appointment_Payment::where('appointment_id',$id)->get();
            if($request->input('isDone')==1 && empty($app_pay)){
        if (Appointment::where('id', $id)->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'isDone' => 0,
            'notes' => $request->input('notes'),
            'dist_r_sphere' => $request->input('dist_r_sphere'),
            'dist_l_sphere' => $request->input('dist_l_sphere'),
            'dist_r_cylinder' => $request->input('dist_r_cylinder'),
            'dist_l_cylinder' => $request->input('dist_l_cylinder'),
            'dist_r_axis' => $request->input('dist_r_axis'),
            'dist_l_axis' => $request->input('dist_l_axis'),
            'pddist' => $request->input('pddist'),
            'near_r_sphere' => $request->input('near_r_sphere'),
            'near_l_sphere' => $request->input('near_l_sphere'),
            'near_r_cylinder' => $request->input('near_r_cylinder'),
            'near_l_cylinder' => $request->input('near_l_cylinder'),
            'near_r_axis' => $request->input('near_r_axis'),
            'near_l_axis' => $request->input('near_l_axis'),
            'pdnear' => $request->input('pdnear'),
        ])) {

            return back()->with('success', __('lang.Updatesuccess'));
        } else
            return back()->with('failed', __('lang.Updatefailed'));}
            else
            {
                if (Appointment::where('id', $id)->update([
                    'date' => $request->input('date'),
                    'time' => $request->input('time'),
                    'isDone' => $request->input('isDone'),
                    'notes' => $request->input('notes'),
                    'dist_r_sphere' => $request->input('dist_r_sphere'),
                    'dist_l_sphere' => $request->input('dist_l_sphere'),
                    'dist_r_cylinder' => $request->input('dist_r_cylinder'),
                    'dist_l_cylinder' => $request->input('dist_l_cylinder'),
                    'dist_r_axis' => $request->input('dist_r_axis'),
                    'dist_l_axis' => $request->input('dist_l_axis'),
                    'pddist' => $request->input('pddist'),
                    'near_r_sphere' => $request->input('near_r_sphere'),
                    'near_l_sphere' => $request->input('near_l_sphere'),
                    'near_r_cylinder' => $request->input('near_r_cylinder'),
                    'near_l_cylinder' => $request->input('near_l_cylinder'),
                    'near_r_axis' => $request->input('near_r_axis'),
                    'near_l_axis' => $request->input('near_l_axis'),
                    'pdnear' => $request->input('pdnear'),
                ])) {
        
                    return back()->with('success', __('lang.Updatesuccess'));
                } else
                    return back()->with('failed', __('lang.Updatefailed'));
            }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
       $data=request()->all();
       $app=Appointment::where('id',$data['id'])->with('payment')->get()->last();
       if(count($app->payment)==0){
            $app->delete();
            return response()->json(['success' => __('lang.Deletesuccess')]);  
        }
        $payment=$app->payment;
        $paid=Payment::find($payment[0]->id);
        $app=Appointment::find($data['id']);
        if($paid->delete() && $app->delete()){
            return response()->json(['success' => __('lang.Deletesuccess')]);  

        }


            
            
    
    }
       
    

    public function MarkDone(Request $request, $id)
    {

        $data = $request->all();
        $payment = new Payment;
        $payment->payment_type = $data['payment_type'];
        if ($data['payment_type'] == 'cash') {
            $payment->payment_currency = $data['payment_currency'];
        }
        $payment->payment = $data['payment'];
        $payment->save();

        $payment = Payment::all()->last();
        $patient = new Patient_Payment;
        $patient->patient_id = $data['patient_id'];
        $patient->payment_id = $payment->id;
        $patient->save();
        $pivot = new Appointment_Payment;
        $pivot->appointment_id = $id;
        $pivot->payment_id = $payment->id;
        $pivot->save();


        if (Appointment::where('id', $id)->update([
            'isDone' => 1,
        ]))

            return response()->json(['success' => "Payment Added and Appointment marked as Done", 'payment_type' => $payment->payment_type, 'payment_currency' => $payment->payment_currency, 'payment' => $payment->payment, 'created_at' => $payment->created_at]);
        else
            return response()->json(['fail' => 'Ajax request submitted successfully']);
    }
}
