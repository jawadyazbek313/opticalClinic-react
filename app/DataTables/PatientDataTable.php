<?php

namespace App\DataTables;

use App\Models\Patient;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $btn = '<div class="row text-center justify-content-center btn-group ltr"><a href="/patient/'.$row->id.'" class="btn btn-primary btn-sm">Show</a><a href="/patient/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                $x = '
                
                <form action="'.route('patient.destroy',$row->id).'" method="POST">
                '.csrf_field().'
                '.method_field("DELETE").'
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm(\'Are You Sure Want to Delete?\')"
                    >Delete</button>
                </form></div>
            ';
                return $btn.$x;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('patient-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addTableClass('hover')
                    ->orderBy(2)
                    ->parameters([
                        'buttons' => ['export'],
                    ]);
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
                  ->width(150),
                  
            Column::make('id')->title(__('ID')),
            Column::make('firstname'),
            Column::make('midname'),
            Column::make('lastname'),
            Column::make('dob'),
            Column::make('insurance'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Patient_' . date('YmdHis');
    }
}
