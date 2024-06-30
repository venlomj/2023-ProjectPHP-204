<?php

namespace App\Http\Livewire\Admin;

use App\Models\Distance;
use Livewire\Component;
use Livewire\WithPagination;

class Distances extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newDistance = [
        'id' => null,
        'name' => null,

    ];

    protected function rules()
    {
        return [
            'newDistance.name' => 'required',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newDistance.name' => 'Distance',


    ];


    public function setNewDistance(Distance $distance = null)
    {
        $this->resetErrorBag();
        if ($distance) {
            $this->newDistance['id'] = $distance->id;
            $this->newDistance['name'] = $distance->name;

        } else {
            $this->reset('newDistance');
        }
        $this->showModal = true;
    }


    // create a new distance
    public function createDistance()
    {
        $this->validate();
        $distance = Distance::create([
            'name' => $this->newDistance['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De afstand <b><i>{$distance->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing distance
    public function updateDistance(Distance $distance)
    {
        $this->validate();
        $distance->update([
            'name' => $this->newDistance['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De afstand <b><i>{$distance->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing distance
    public function deleteDistance (Distance $distance)
    {
        $distance->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De afstand <b><i>{$distance->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $distances = Distance::orderBy('id')
            ->paginate($this->perPage);
        return view('livewire.admin.distances', compact('distances'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren afstanden',
                'title' => 'Afstanden beheren',
            ]);
    }
}

