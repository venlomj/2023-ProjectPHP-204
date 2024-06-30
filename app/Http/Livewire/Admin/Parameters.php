<?php

namespace App\Http\Livewire\Admin;

use App\Models\Parameter;
use Livewire\Component;
use Livewire\WithPagination;

class Parameters extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newParameter = [
        'id' => null,
        'name' => null,
        'value' => null,

    ];

    protected function rules()
    {
        return [
            'newParameter.name' => 'required',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newParameter.name' => 'Parameter',


    ];


    // set/reset $newParameter and validation
    public function setNewParameter(Parameter $parameter = null)
    {
        $this->resetErrorBag();
        if ($parameter) {
            $this->newParameter['id'] = $parameter->id;
            $this->newParameter['name'] = $parameter->name;
            $this->newParameter['value'] = $parameter->value;

        } else {
            $this->reset('newParameter');
        }
        $this->showModal = true;
    }


    // create a new parameter
    public function createParameter()
    {
        $this->validate();
        $parameter = Parameter::create([
            'name' => $this->newParameter['name'],
            'value' => $this->newParameter['value'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De parameter <b><i>{$parameter->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing parameter
    public function updateParameter(Parameter $parameter)
    {
        $this->validate();
        $parameter->update([
            'name' => $this->newParameter['name'],
            'value' => $this->newParameter['value'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De parameter <b><i>{$parameter->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing parameter
    public function deleteParameter (Parameter $parameter)
    {
        $parameter->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De parameter <b><i>{$parameter->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $parameters = Parameter::orderBy('id')
            ->paginate($this->perPage);
        return view('livewire.admin.parameters', compact('parameters'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van parameters',
                'title' => 'Parameters beheren',
            ]);
    }
}
