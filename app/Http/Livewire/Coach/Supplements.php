<?php

namespace App\Http\Livewire\Coach;

use App\Models\Supplement;
use Livewire\Component;
use Livewire\WithPagination;

class Supplements extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newSupplement = [
        'id' => null,
        'name' => null,
        'unit' => null
    ];

    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        return [
            'newSupplement.name' => 'required',
            'newSupplement.unit' => 'required'
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newSupplement.name' => 'supplement name',
        'newSupplement.unit' => 'unit name'

    ];


    public function setNewSupplement(Supplement $supplement = null)
    {
        $this->resetErrorBag();
        if ($supplement) {
            $this->newSupplement['id'] = $supplement->id;
            $this->newSupplement['name'] = $supplement->name;
            $this->newSupplement['unit'] = $supplement->unit;
        } else {
            $this->reset('newSupplement');
        }
        $this->showModal = true;
    }

    // reset the paginator
//    public function updated($propertyName, $propertyValue)
//    {
//        $this->resetPage();
//    }

    // create a new supplement
    public function createSupplement()
    {
        $this->validate();
        $supplement = Supplement::create([
            'name' => $this->newSupplement['name'],
            'unit' => $this->newSupplement['unit']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het supplement <b><i>{$supplement->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing supplement
    public function updateSupplement(Supplement $supplement)
    {
        $this->validate();
        $supplement->update([
            'name' => $this->newSupplement['name'],
            'unit' => $this->newSupplement['unit'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het supplement <b><i>{$supplement->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing supplement
    public function deleteSupplement(Supplement $supplement)
    {
        $supplement->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "Het supplement <b><i>{$supplement->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $supplements = Supplement::orderBy('name')->orderBy('unit')
            ->paginate($this->perPage);
        return view('livewire.coach.supplements', compact('supplements'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheer van supplementen',
                'title' => 'Beheren supplementen',
            ]);
    }



}
