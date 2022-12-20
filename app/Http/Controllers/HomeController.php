<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return User::role('admin')->get();
        // Role::create(["name"=>'secretary']);
        // Permission::create(['name'=>'add patient']);
        // Permission::create(['name'=>'view patient']);
        // Permission::create(['name'=>'edit patient']);
        // Permission::create(['name'=>'delete patient']);
        // Permission::create(['name'=>'add appointment']);
        // Permission::create(['name'=>'view appointment']);
        // Permission::create(['name'=>'edit appointment']);
        // Permission::create(['name'=>'delete appointment']);

        // $role=Role::findById(2);
        // for($i=2;$i<=9;$i++){
        //     $permission=Permission::findById($i);
        //     $role->givePermissionTo($permission);
        // }

        $appointmentsForToday = Appointment::select('id', 'date', 'time', 'isDone', 'notes')
            ->where('date', '=', date('Y-m-d'))
            ->where('trashed', 0)
            ->orderBy('isDone', 'ASC')
            ->orderBy('date', 'ASC')
            ->orderBy('time', 'ASC')
            ->with('patient:id,firstname,midname,lastname')
            ->with('payment')
            ->paginate(7);
        $countme = Appointment::select('id', 'date', 'isDone', 'notes')
            ->where('trashed', 0)
            ->where('date', '=', date('Y-m-d'))->count();
        $patients = Patient::select('id', 'firstname', 'midname', 'lastname', 'dob')->limit(50)->get();

        $appointmentsTomorrow = Appointment::select('id', 'date', 'time', 'isDone', 'notes')
            ->where('date', '=', Carbon::tomorrow()->toDateString())->orderBy('isDone', 'ASC')
            ->orderBy('date', 'ASC')
            ->orderBy('time', 'ASC')
            ->with('patient:id,firstname,midname,lastname')
            ->with('payment')
            ->paginate(7);
            $countmeappointmentsTomorrow = Appointment::select('id', 'date', 'isDone', 'notes')
            ->where('date', '>', Carbon::today()->toDateString())->count();
         
        return view('home', compact('appointmentsTomorrow', 'countme', 'patients','appointmentsForToday','countmeappointmentsTomorrow'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $appointments = Appointment::select('id', 'date', 'time', 'isDone', 'notes')
                ->where('date', ($request->AppointmentsOf=='today'?'=':'>'), date('Y-m-d'))
                ->where('trashed', 0)
                ->orderBy('isDone', 'ASC')
                ->orderBy('date', 'ASC')
                ->orderBy('time', 'ASC')
                ->orderBy('updated_at', 'DESC')
                ->with('patient:id,firstname,midname,lastname')
                ->with('payment')
                ->paginate(7);


            $countme = Appointment::select('id', 'date', 'time', 'isDone', 'notes')
                ->where('date', ($request->AppointmentsOf=='today'?'=':'>'), date('Y-m-d'))
                ->where('trashed', 0)
                ->orderBy('date', 'ASC')
                ->orderBy('time', 'ASC')
                ->count();

            $AppointmentsFor='tomorrow';
            return view('AppointmentsForHomePage', compact('appointments', 'countme','AppointmentsFor'))->render();
        }
    }

}
