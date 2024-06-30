<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sex;
use Livewire\Component;
use Livewire\WithPagination;

class Genders extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newGender = [
        'id' => null,
        'name' => null,

    ];

    protected function rules()
    {
        return [
            'newGender.name' => 'required',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newGender.name' => 'Gender',


    ];



    public function setNewGender(Sex $gender = null)
    {
        $this->resetErrorBag();
        if ($gender) {
            $this->newGender['id'] = $gender->id;
            $this->newGender['name'] = $gender->name;

        } else {
            $this->reset('newGender');
        }
        $this->showModal = true;
    }


    // create a new gender
    public function createGender()
    {
        $this->validate();
        $gender = Sex::create([
            'name' => $this->newGender['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gender <b><i>{$gender->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing gender
    public function updateGender(Sex $gender)
    {
        $this->validate();
        $gender->update([
            'name' => $this->newGender['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gender <b><i>{$gender->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing gender
    public function deleteGender (Sex $gender)
    {
        $gender->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De gender <b><i>{$gender->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $genders = Sex::orderBy('id')
            ->paginate($this->perPage);
        return view('livewire.admin.genders', compact('genders'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van genders',
                'title' => 'Genders beheren',
            ]);
    }
}
