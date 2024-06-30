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

class Competitions extends Component
{
    use WithPagination;
    public $locations;
    public $countries;
    public $series;
    public $distances;
    public $strokes;
    public $sexes;
    public $search;
    public $loading = 'Even geduld, a.u.b. ...';

    public $contests;
    public $perPage = 5;
    public $showModal = false;
    public $showModal1 = false;
    public $showModal2 = false;
    public $showModal3 = false;
    public $showModal4 = false;
    public $selectedCompetitionId;

    public $selectedCompetitionName;

    public $newCompetition = [
        'id' => null,
        'name' => null,
        'date' => null,
        'video_url' => null,
        'location_id' => null,
    ];

    public $newLocation = [
        'id' => null,
        'name' => null,
        'street' => null,
        'street_number' => null,
        'city' => null,
        'postal_code' => null,
        'country_id' => null
    ];

    public $newSerie = [
        'id' => null,
        'start_time' => null,
        'contest_id' => null,
        'stroke_id' => null,
        'distance_id' => null,
        'sex_id' => null,
        'follow_number' => null
    ];

    public $newCountry = [
        'id' => null,
        'name' => null
    ];

    // validation rules (use the rules() method, not the $rules property)


    public function mount()
    {
        $this->locations = Location::orderBy('name')->get();
        $this->countries = Country::orderBy('name')->get();
        $this->series = Series::orderBy('follow_number')->get();
        $this->contests = Contest::orderBy('name')->get();
        $this->distances = Distance::orderBy('name')->get();
        $this->strokes = Stroke::orderBy('name')->get();
        $this->sexes = Sex::orderBy('name')->get();
    }


    public function setNewCompetition(Contest $competition = null)
    {
        $this->resetErrorBag();
        if ($competition) {
            $this->newCompetition['id'] = $competition->id;
            $this->newCompetition['name'] = $competition->name;
            $this->newCompetition['date'] = $competition->date;
            $this->newCompetition['video_url'] = $competition->video_url;
            $this->newCompetition['location_id'] = $competition->location_id;
            $this->selectedCompetitionId = $competition->id;

        } else {
            $this->reset('newCompetition');
        }



        $this->showModal1 = false;
        $this->showModal2 = false;
        $this->showModal4 = false;
        $this->showModal = true;


    }


    // create a new competition
    public function createCompetition()
    {

        $competition = Contest::create([
            'name' => $this->newCompetition['name'],
            'date' => $this->newCompetition['date'],
            'video_url' => $this->newCompetition['video_url'],
            'location_id' => $this->newCompetition['location_id']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De competitie <b><i>{$competition->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing competition
    public function updateCompetition(Contest $competition)
    {
        $competition->update([
            'name' => $this->newCompetition['name'],
            'date' => $this->newCompetition['date'],
            'video_url' => $this->newCompetition['video_url'],
            'location_id' => $this->newCompetition['location_id']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De competitie <b><i>{$competition->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing competition
    public function deleteCompetition(Contest $competition)
    {
        $competition->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "De competitie <b><i>{$competition->name}</i></b> is verwijderd",
        ]);

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
        $this->showModal = false;
        $this->showModal4 = false;
        $this->showModal1 = true;
    }

    public function fetchLocations()
    {
        $this->locations = Location::all();
    }

    public function createLocation()
    {
        $location = Location::create([
            'name' => $this->newLocation['name'],
            'street' => $this->newLocation['street'],
            'street_number' => $this->newLocation['street_number'],
            'city' => $this->newLocation['city'],
            'postal_code' => $this->newLocation['postal_code'],
            'country_id' => $this->newLocation['country_id'],
        ]);

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De locatie <b><i>{$location->name}</i></b> is toegevoegd",
        ]);

        $this->showModal1 = false;
        $this->showModal = true;

        $this->fetchLocations();

    }

    public function setNewSerie(Series $serie = null)
    {
        $this->resetErrorBag();
        if ($serie) {
            $this->newSerie['id'] = $serie->id;
            $this->newSerie['start_time'] = $serie->start_time;
            $this->selectedCompetitionId = $this->newCompetition['id'];
            $this->newSerie['stroke_id'] = $serie->stroke_id;
            $this->newSerie['distance_id'] = $serie->distance_id;
            $this->newSerie['sex_id'] = $serie->sex_id;
            $this->newSerie['follow_number'] = $serie->follow_number;

        } else {
            $this->reset('newSerie');
        }

        $this->selectedCompetitionName = Contest::find($this->selectedCompetitionId)->name;


        $this->showModal = false;
        $this->showModal2 = true;
    }

    public function createSerie()
    {
        $serie = Series::create([
            'start_time' => $this->newSerie['start_time'],
            'contest_id' => $this->newCompetition['id'],
            'stroke_id' => $this->newSerie['stroke_id'],
            'distance_id' => $this->newSerie['distance_id'],
            'sex_id' => $this->newSerie['sex_id'],
            'follow_number' => $this->newSerie['follow_number']
        ]);
        $this->showModal2 = false;
        $this->showModal = true;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De reeks <b><i>{$serie->name}</i></b> is toegevoegd",
        ]);

    }

    public function showSerie($competitionId)
    {
        $this->series = Series::where('contest_id', $competitionId)->get();
        $this->showModal3 = true;
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
        $this->showModal1 = false;
        $this->showModal4 = true;
    }

    public function fetchCountries()
    {
        $this->countries = Country::all();
    }

    public function createCountry()
    {
        $country = Country::create([
            'name' => $this->newCountry['name']
        ]);

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het land <b><i>{$country->name}</i></b> is toegevoegd",
        ]);

        $this->showModal4 = false;
        $this->showModal1 = true;

        $this->fetchCountries();

    }

    public function render()
    {

        $allCountries = Country::has('locations')->withCount('locations')->get();
        $query = Contest::orderBy('name')->orderBy('name')
            ->searchLastNameOrFirstName($this->search);
        $competitions = $query->paginate($this->perPage);
        return view('livewire.coach.competitions', compact('competitions', 'allCountries'))

            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van de zwemcompetities',
                'title' => 'Beheren van competities',
            ]);
    }
}
