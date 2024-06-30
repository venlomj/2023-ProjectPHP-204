<?php

namespace App\Http\Livewire\Coach;

use App\Models\Contest;
use App\Models\Country;
use App\Models\Distance;
use App\Models\Location;
use App\Models\Series;
use App\Models\Sex;
use App\Models\Stroke;
use Livewire\Component;
use Livewire\WithPagination;

class Locations extends Component
{
    use WithPagination;
    public $countries;
    public $showModal = false;
    public $showModal1 = false;
    public $perPage = 5;

    public $newLocation = [
        'id' => null,
        'name' => null,
        'street' => null,
        'street_number' => null,
        'city' => null,
        'postal_code' => null,
        'country_id' => null
    ];

    public $newCountry = [
        'id' => null,
        'name' => null
    ];

    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        return [
            'newCompetition.name' => 'required',
            'newCompetition.date' => 'required',
            'newCompetition.video_url' => 'required',
            'newCompetition.location_id' => 'required'
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newCompetition.name' => 'competition name',
        'newCompetition.date' => 'date',
        'newCompetition.video_url' => 'video url',
        'newCompetition.location_id' => 'location'

    ];


    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
    }


    public function setNewLocation(Location $location = null)
    {
        $this->resetErrorBag();
        if ($location) {
            $this->newLocation['id'] = $location->id;
            $this->newLocation['name'] = $location->name;
            $this->newLocation['street'] = $location->street;
            $this->newLocation['street_number'] = $location->street_number;
            $this->newLocation['city'] = $location->city;
            $this->newLocation['postal_code'] = $location->postal_code;
            $this->newLocation['country_id'] = $location->country_id;

        } else {
            $this->reset('newLocation');
        }
        $this->showModal = true;
    }


    public function createLocation()
    {
      // $this->validate();
        $location = Location::create([
            'name' => $this->newLocation['name'],
            'street' => $this->newLocation['street'],
            'street_number' => $this->newLocation['street_number'],
            'city' => $this->newLocation['city'],
            'postal_code' => $this->newLocation['postal_code'],
            'country_id' => $this->newLocation['country_id'],
        ]);

        $this->showModal = false;

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De locatie <b><i>{$location->name}</i></b> is toegevoegd",
        ]);


    }

    // update an existing location
    public function updateLocation(Location $location)
    {
      //  $this->validate();
        $location->update([
            'name' => $this->newLocation['name'],
            'street' => $this->newLocation['street'],
            'street_number' => $this->newLocation['street_number'],
            'city' => $this->newLocation['city'],
            'postal_code' => $this->newLocation['postal_code'],
            'country_id' => $this->newLocation['country_id'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De locatie <b><i>{$location->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing location
    public function deleteLocation(Location $location)
    {
        $location->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De locatie <b><i>{$location->name}</i></b> is verwijderd",
        ]);

    }

    public function setNewCountry(Country $country = null)
    {
        $this->resetErrorBag();
        if ($country) {
            $this->newCountry['id'] = $country->id;
            $this->newCountry['name'] = $country->name;

        } else {
            $this->reset('newCountry');
        }
        $this->showModal = false;
        $this->showModal1 = true;
    }

    public function fetchCountries()
    {
        $this->countries = Country::all();
    }

    public function createCountry()
    {
//        $this->validate();
        $country = Country::create([
            'name' => $this->newCountry['name']
        ]);

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het land <b><i>{$country->name}</i></b> is toegevoegd",
        ]);

        $this->showModal1 = false;
        $this->showModal = true;

        $this->fetchCountries();

    }


    public function render()
    {
        $locations = Location::orderBy('name')
            ->paginate($this->perPage);
        return view('livewire.coach.locations', compact('locations'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van locaties',
                'title' => 'Beheren van locaties',
            ]);
    }
}
