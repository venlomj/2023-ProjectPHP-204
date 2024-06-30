<?php

namespace App\Http\Livewire\Coach;

use App\Models\Location;
use App\Models\Training;
use App\Models\TrainingType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Trainings extends Component
{
    use WithPagination;

    public $search;
    public $users;
    public $trainingsTypes;
    public $locations;
    public $perPage = 5;
    public $showModal = false;

    public $newTraining = [
        'id' => null,
        'start_time' => null,
        'end_time' => null,
        'is_sent' => null,
        'user_id' => null,
        'training_type_id' => null,
        'location_id' => null,
    ];

     protected function rules()
     {
         return [
             'newTraining.start_time' => 'required',
             'newTraining.end_time' => 'required',
             'newTraining.user_id' => 'required',
             'newTraining.training_type_id' => 'required',
             'newTraining.location_id' => 'required',

         ];
     }

    // validation attributes
    protected $validationAttributes = [

        'newTraining.id' => 'id',
        'newTraining.start_time' => 'start time',
        'newTraining.end_time' => 'end time',
        'newTraining.is_sent' => 'is sent',
        'newTraining.user_id' => 'user id',
        'newTraining.training_type_id' => 'training type',
        'newTraining.location_id' => 'location',
    ];

    public function mount()
    {
        $this->users = User::orderBy('first_name')->get();
        $this->trainingsTypes = TrainingType::orderBy('id')->get();
        $this->locations = Location::orderBy('name')->get();
    }


    public function setNewTraining(Training $training = null)
    {
        $this->resetErrorBag();
        if ($training) {
            $this->newTraining['id'] = $training->id;
            $this->newTraining['start_time'] = $training->start_time;
            $this->newTraining['end_time'] = $training->end_time;
            $this->newTraining['user_id'] = $training->user_id;
            $this->newTraining['training_type_id'] = $training->training_type_id;
            $this->newTraining['location_id'] = $training->location_id;


        } else {
            $this->reset('newTraining');
        }
        $this->showModal = true;
    }


    // create a new training
    public function createTraining()
    {
        $this->validate();
        $training = Training::create([

            'start_time' => $this->newTraining['start_time'],
            'end_time' => $this->newTraining['end_time'],
            'user_id' => $this->newTraining['user_id'],
            'training_type_id' => $this->newTraining['training_type_id'],
            'location_id' => $this->newTraining['location_id'],
        ]);

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De training <b><i>{$training->id}</i></b> is toegevoegd",
        ]);
        $this->showModal = false;

    }

    //update existing training
    public function updateTraining(Training $training)
    {
        $this->validate();
        $training->update([
            'start_time' => $this->newTraining['start_time'],
            'end_time' => $this->newTraining['end_time'],
            'user_id' => $this->newTraining['user_id'],
            'training_type_id' => $this->newTraining['training_type_id'],
            'location_id' => $this->newTraining['location_id'],

        ]);

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De training <b><i>{$training->name}</i></b> is aangepast",
        ]);
        $this->showModal = false;

    }

    // delete an existing training
    public function deleteTraining(Training $training)
    {
        $training->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De training <b><i>{$training->id}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $training = Training::orderBy('start_time')
            ->paginate($this->perPage);
        return view('livewire.coach.trainings', compact('training'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van training',
                'title' => 'Beheren trainingen',
            ]);
    }
}

