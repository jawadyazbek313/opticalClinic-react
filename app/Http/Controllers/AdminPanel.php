<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }


    public function index()
    {
        $totalMonthLBP=Payment::where('created_at', '>=' ,date('Y-m-01').' 00:00:00' )
                    ->where('payment_type','=','cash')    
                    ->where('payment_currency','=','lbp')
                    ->sum('payment');

        $totalMonthUSD=Payment::where('created_at', '>=' ,date('Y-m-01').' 00:00:00' )
                    ->where('payment_type','=','cash')    
                    ->where('payment_currency','=','us')
                    ->sum('payment');

         $totalLBP=Payment::
                    where('payment_type','=','cash')    
                    ->where('payment_currency','=','lbp')
                    ->sum('payment');

        $totalUSD=Payment::
                    where('payment_type','=','cash')    
                    ->where('payment_currency','=','us')
                    ->sum('payment');
        $totalMonthApp=Appointment::where('date', '>=' ,date('01-m-Y') )
                                    ->where('isDone',1)->count();
        $totalApp=Appointment::where('isDone',1)->count();

        return view('admin.index',compact('totalMonthLBP','totalMonthUSD','totalLBP','totalUSD','totalMonthApp','totalApp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
