<?php

namespace App\Http\Livewire\Coach;

use App\Models\Training;
use App\Models\TrainingType;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingsTypes extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newTrainingsType = [
        'id' => null,
        'name' => null,

    ];

    protected function rules()
    {
        return [
            'newTrainingsType.name' => 'required',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newTrainingsType.name' => 'Trainings type',


    ];



    public function setNewTrainingsType(TrainingType $trainingType = null)
    {
        $this->resetErrorBag();
        if ($trainingType) {
            $this->newTrainingsType['id'] = $trainingType->id;
            $this->newTrainingsType['name'] = $trainingType->name;

        } else {
            $this->reset('newTrainingsType');
        }
        $this->showModal = true;
    }


    // create a new type
    public function createTrainingsType()
    {
        $this->validate();
        $trainingType = TrainingType::create([
            'name' => $this->newTrainingsType['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het type <b><i>{$trainingType->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing type
    public function updateTrainingsType(TrainingType $trainingType)
    {
        $this->validate();
        $trainingType->update([
            'name' => $this->newTrainingsType['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het type <b><i>{$trainingType->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing type
    public function deleteTrainingsType(TrainingType $trainingType)
    {
        $trainingType->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "Het type <b><i>{$trainingType->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $trainingsTypes = TrainingType::orderBy('id')
            ->paginate($this->perPage);
        return view('livewire.coach.trainings-types', compact('trainingsTypes'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van trainings types',
                'title' => 'Training types beheren',
            ]);
    }
}
