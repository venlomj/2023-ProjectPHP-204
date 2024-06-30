<?php

namespace App\Http\Livewire\Admin;

use App\Models\Stroke;
use Livewire\Component;
use Livewire\WithPagination;

class Strokes extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newStroke = [
        'id' => null,
        'name' => null,

    ];

    protected function rules()
    {
        return [
            'newStroke.name' => 'required',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newStroke.name' => 'Stroke',


    ];



    public function setNewStroke(Stroke $stroke = null)
    {
        $this->resetErrorBag();
        if ($stroke) {
            $this->newStroke['id'] = $stroke->id;
            $this->newStroke['name'] = $stroke->name;

        } else {
            $this->reset('newStroke');
        }
        $this->showModal = true;
    }


    // create a new stroke
    public function createStroke()
    {
        $this->validate();
        $stroke = Stroke::create([
            'name' => $this->newStroke['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De slag <b><i>{$stroke->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing stroke
    public function updateStroke(Stroke $stroke)
    {
        $this->validate();
        $stroke->update([
            'name' => $this->newStroke['name'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De slag <b><i>{$stroke->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing record
    public function deleteStroke (Stroke $stroke)
    {
        $stroke->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De slag <b><i>{$stroke->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $strokes = Stroke::orderBy('id')
            ->paginate($this->perPage);
        return view('livewire.admin.strokes', compact('strokes'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van slagen',
                'title' => 'Slagen beheren',
            ]);
    }
}

