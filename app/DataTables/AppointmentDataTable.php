<?php

namespace App\DataTables;

use App\Models\Appointment;
use App\Http\Controllers\Relation;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppointmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   $model = Appointment::with('patient');
        return datatables()
            ->eloquent($model)
            ->addColumn('action', function ($row) {
                $btn = '<div class="row text-center justify-content-center"><a href="/appointment/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                $x = '
                
                <form action="'.route('appointment.destroy',$row->id).'" method="POST">
                '.csrf_field().'
                '.method_field("DELETE").'
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm(\'Are You Sure Want to Delete?\')"
                    >Delete</button>
                </form>
             
            ';

          

                return $btn.$x;

            })
            ->addColumn('isDoneCompute', function ($row) {
                $relation=Appointment::with('patient')->find($row->id);
                if($row->isDone=='0'){
                    $y='
                    <button type="button" class="btn btn-success btn-md" data-appointment_id="'.$row->id.'" data-patient_id="'.$relation->patients[0]->original->id.'" 
                        onclick="showMarkAsDoneModal()"
                        >MarkAsDone</button>';
                    return $y;
                }
                return '<h5>Done</h5>';
            })
            ->rawColumns(['isDoneCompute','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model)
    {
        return Appointment::with('patient');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('appointment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('date'),
            Column::computed('isDoneCompute')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Appointment_' . date('YmdHis');
    }
}
