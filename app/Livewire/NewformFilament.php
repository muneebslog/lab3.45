<?php

namespace App\Livewire;

use App\Models\Test;
use App\Models\Patient;

use Livewire\Component;

use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class NewformFilament extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('receipt_no')
                    ->label('Receipt No')
                    ->numeric()
                    ->required()
                    ->maxLength(100),
                Section::make('')
                ->columns(2)
                    ->schema([
                        // ...
                        TextInput::make('age')
                            ->numeric()
                            ->default(null),
                        Select::make('age_unit')
                            ->options([
                                'Month' => 'Month',
                                'Year' => 'Year',
                            ])
                            ->default('Year')
                            ->required()
                    ]),

                Select::make('gender')
                    ->required()
                    ->default('male')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                TextInput::make('phone')
                    ->tel()
                    ->numeric()
                    ->nullable()
                    ->maxLength(12)
                    ->minLength(11)
                    ->default(null),
                Select::make('doctor')
                    ->required()
                    ->label('Refered By')
                    ->options([
                        'Self' => 'Self',
                        'Dr. Maliha Tariq' => 'Dr. Maliha Tariq',
                        'Dr. Sadia Sohail' => 'Dr. Sadia Sohail',
                        'Dr. Gul' => 'Dr. Gul',
                        'Dr. M. Bilal' => 'Dr. M. Bilal',
                        'Dr. Sohail' => 'Dr. Sohail',
                        'Dr. Tariq Saeed' => 'Dr. Tariq Saeed',
                        'Dr. M. Ahtesham' => 'Dr. M. Ahtesham',
                        'Dr. M. Ahmer' => 'Dr. M. Ahmer',
                        'Dr. Arslan ' => 'Dr. Arslan ',

                    ]),
                Select::make('tests')
                    // ->relationship('tests', 'name')
                    ->options(Test::all()->pluck('name', 'id'))
                    ->preload()
                    ->required()
                    ->multiple(),
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        // dd($this->form->getState());
        $data = $this->form->getState();

        $patient = Patient::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'age_unit' => $data['age_unit'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'receipt_no' => $data['receipt_no'],
            'doctor' => $data['doctor'],
        ]);
        // dd($patient);
        $patient->tests()->attach($data['tests']);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
        $this->redirect('/invoice/' . $patient->id);
    }
    public function render()
    {
        return view('livewire.newform-filament');
    }
}
