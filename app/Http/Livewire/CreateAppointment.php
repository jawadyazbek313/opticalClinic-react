<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class CreateAppointment extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Appointment $appointment;
    public $date;
    public $time;
    public $isDone;
    public $notes;
    protected function getFormSchema(): array
    {
        return [
            Select::make('patient_id')
                ->searchable()
                ->getSearchResultsUsing(fn (string $search) => Patient::where('firstname', 'like', "%{$search}%")
                    ->orWhere('midname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->limit(50)
                    ->pluck('firstname','midname', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => Patient::find($value)?->firstname.' '.Patient::find($value)?->lastname),
            Forms\Components\DatePicker::make('date')->required(),
            Forms\Components\TimePicker::make('time')->required(),
            Forms\Components\Toggle::make('isDone')->required(),
            Forms\Components\MarkdownEditor::make('notes'),
            // ...
        ];
    }

    protected function getFormModel(): Appointment
    {
        return $this->appointment;
    }

    public function mount(Appointment $appointment): void
    {
        $this->appointment = $appointment;

        $this->form->fill();
    }

    public function submit(): void
    {
        $this->appointment->update(
            $this->form->getState(),
        );
    }




    public function render(): View
    {
        return view('livewire.create-appointment');
    }
}
