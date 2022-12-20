<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddAppointmentForm extends Component implements Forms\Contracts\HasForms 
{
    use Forms\Concerns\InteractsWithForms; 


    public Appointment $appointment;
 
    public $patientID;
    public $date;
    public $time;
 
    public function mount(): void
    {
        $this->form->fill([
            'patientID' => $this->appointment->appointment_patient->patient_id,
            'date' => $this->appointment->date,
            'time' => $this->appointment->time,
        ]);
    }
 
    protected function getFormModel(): Appointment 
    {
        return $this->appointment;
    } 

    protected function getFormSchema(): array 
    {
        return [
            Forms\Components\Select::make('patientID')->required()->relationship('patient', 'firstname'),
            Forms\Components\MarkdownEditor::make('content'),
            // ...
        ];
    } 
    public function save(): void
    {
        $this->appointment->update(
            $this->form->getState(),
        );
    } 
    public function submit(): void
    {
        // ...
    }
     
    public function render()
    {
        return view('livewire.add-appointment-form');
    }
}
