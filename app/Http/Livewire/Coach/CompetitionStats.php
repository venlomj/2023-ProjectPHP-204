<?php

namespace App\Http\Livewire\Coach;

use App\Models\Contest;
use App\Models\Series;
use App\Models\Stroke;
use App\Models\UserSeries;
use Livewire\Component;
use Livewire\WithPagination;

class CompetitionStats extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 5;
    public $selectedCompetitionStat;
    public $selectedCompetitionStatUserName;
    public $selectedUserSerie;
    public $selectedUserSerieId;

    public $userSeries;

    public $selectedStatId;

    public $showModal = false;

    public $newStat = [

        'id' => null,
        'user_id' => null,
        'series_id' => null,
        'time_travelled' => null,
        'subscription_date' => null,
        'confirmation_date' => null,
        'status_id' => null,

    ];

    protected function rules()
    {

    }

    // validation attributes
    protected $validationAttributes = [
        'newStat.id' => 'id',
        'newStat.user_id' => 'user id',
        'newStat.series_id' => 'series id',
        'newStat.time_travelled' => 'time travelled',
        'newStat.subscription_date' => 'subscription date',
        'newStat.confirmation_date' => 'confirmation date',
        'newStat.status_id' => 'status id',


    ];

    public function mount()
    {

        $this->series = Series::orderBy('follow_number')->get();
        $this->strokes = Stroke::orderBy('name')->get();
    }

    public function setNewStat($userserieId)
    {
        $this->selectedUserSerieId = $userserieId;
        $userSeries = UserSeries::findOrFail($userserieId);
        $userSerie = UserSeries::find($this->selectedUserSerieId);
        $this->time_travelled = $userSerie->time_travelled;

        $this->selectedCompetitionStat = $userSeries->series->contest->name;
        $this->selectedCompetitionStatUserName = $userSeries->user->user_name;


        $this->showModal = true;

    }
    public function createStat()
    {

        $stat = UserSeries::create([
            'series_id' => $this->newStat['series_id'],
            'user_id' => $this->newStat['user_id'],
            'time_travelled' => $this->newStat['time_travelled'],
            'subscription_date' => $this->newStat['subscription_date'],
            'confirmation_date' => $this->newStat['confirmation_date'],
            'status_id' => $this->newStat['status_id'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The competitie prestatie <b><i>{$stat->name}</i></b> zijn toegevoegd",
        ]);

    }

    // update an existing stat
    public function updateStat()
    {
        $this->validate([
            'time_travelled' => 'required',
        ]);
        $userSerie = UserSeries::find($this->selectedUserSerieId);
        $userSerie->time_travelled = $this->time_travelled;
        $userSerie->save();

        $this->showModal = false;

    }

    // delete an existing stat
    public function deleteStat (UserSeries $stat)
    {
        $stat->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "The competitie prestaties <b><i>{$stat->series_id}</i></b> zijn verwijderd",
        ]);

    }

    public function render()
    {
        $userseries = UserSeries::
            with('user')
            ->with('series')
            ->with('series.contest')
            ->paginate($this->perPage);
        //dd($userseries);
        return view('livewire.coach.competition-stats', compact('userseries'))
            ->layout('layouts.zwemclub', [
                'description' => 'Hier worden de wedstrijd prestaties toegevoegd',
                'title' => 'Wedstrijd prestaties',
            ]);
    }
}
