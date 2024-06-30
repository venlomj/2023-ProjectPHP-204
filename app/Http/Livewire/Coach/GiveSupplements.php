<?php

namespace App\Http\Livewire\Coach;

use App\Models\Supplement;
use App\Models\User;
use App\Models\UserSupplement;
use Livewire\Component;
use Livewire\WithPagination;

class GiveSupplements extends Component
{
    use WithPagination;
    public $search;
    public $users;
    public $supplements;
    public $perPage = 5;
    public $showModal = false;

    public $newSwimmerSupplement = [
        'id' => null,
        'user_id' => null,
        'supplement_id' => null,
        'supplement_schedule' => null,
        'amount' => null,
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

    public function mount()
    {
        $this->users = User::orderBy('first_name')->get();
        $this->supplements = Supplement::orderBy('name')->get();
    }


    public function setNewUserSupplement(UserSupplement $usersupplement = null)
    {
        $this->resetErrorBag();
        if ($usersupplement) {
            $this->newSwimmerSupplement['id'] = $usersupplement->id;
            $this->newSwimmerSupplement['user_id'] = $usersupplement->user_id;
            $this->newSwimmerSupplement['supplement_id'] = $usersupplement->supplement_id;
            $this->newSwimmerSupplement['supplement_schedule'] = $usersupplement->supplement_schedule;
            $this->newSwimmerSupplement['amount'] = $usersupplement->amount;
        } else {
            $this->reset('newSwimmerSupplement');
        }
        $this->showModal = true;
    }



    // create a new supplement
    public function createNewUserSupplement()
    {
      $this->validate();
        $usersupplement = UserSupplement::create([
            'user_id' => $this->newSwimmerSupplement['user_id'],
            'supplement_id' => $this->newSwimmerSupplement['supplement_id'],
            'supplement_schedule' => $this->newSwimmerSupplement['supplement_schedule'],
            'amount' => $this->newSwimmerSupplement['amount']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'succes',
            'html' => "Het supplement <b><i>{$usersupplement->name}</i></b> is toegewezen",
        ]);

    }

    // update an existing supplement
    public function updateNewUserSupplement(UserSupplement $usersupplement)
    {
       $this->validate();
        $usersupplement->update([
            'user_id' => $this->newSwimmerSupplement['user_id'],
            'supplement_id' => $this->newSwimmerSupplement['supplement_id'],
            'supplement_schedule' => $this->newSwimmerSupplement['supplement_schedule'],
            'amount' => $this->newSwimmerSupplement['amount']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het supplement <b><i>{$usersupplement->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing supplement
    public function deleteNewUserSupplement(UserSupplement $usersupplement)
    {
        $usersupplement->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "Het supplement <b><i>{$usersupplement->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $usersupplements = UserSupplement::orderBy('id')
        ->paginate($this->perPage);
        return view('livewire.coach.give-supplements', compact('usersupplements'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheer van toewijzen van supplementen',
                'title' => 'Toewijzen van supplementen',
            ]);
    }



}
