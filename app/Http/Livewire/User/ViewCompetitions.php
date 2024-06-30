<?php

namespace App\Http\Livewire\User;

use App\Models\Contest;
use App\Models\Location;
use App\Models\Series;
use App\Models\Stroke;
use App\Models\User;
use App\Models\UserSeries;
use Livewire\Component;

class ViewCompetitions extends Component
{

    public $showModal = false;
    public $showSecondModal = false;

    public $showThirdModal = false;
    public $loading = 'Even geduld, a.u.b. ...';

    public $users;
    public $userseries;
    public $groupBySeries;

    public $series;
    public $selectedUserId;

    public $selectedCompetition;
    public $selectedSeries;
    public $selectedStatusId;

    public $selectedCompetitionName;
    public $selectedCompetitionDate;

    public $selectedUsername;
    public $selectedUserSeries;
    public $contests;

    public $test;


    public function loadGroupBySeries()
    {
        $this->groupBySeries = UserSeries::orderBy('status_id')
            ->with('user', 'series.contest', 'status', 'series.distance')
            ->get()
            ->groupBy(function ($item) {
                return $item->series->contest->name . ' ' . $item->series->contest->date . ' ' . $item->user->user_name . ' ' . $item->status->name;
            })
            ->map(function ($group) {
                return $group->first();
            });
    }
    public function mount()
    {
        $this->locations = Location::orderBy('name')->get();
        $this->users = User::orderBy('first_name')->get();
        $this->series = Series::orderBy('id')->get();
        $this->contests = Contest::all();
        $this->loadGroupBySeries();

//        dump($this->groupBySeries->toArray());
    }

    public function registrationCompetition(){
        $this->showSecondModal = false;
        $this->showModal = true;

    }

    public function setDefaultCompetition()
    {
        $this->selectedCompetition = $this->contests->first()->id;
    }


    public function openSecondModal()
    {
        $this->selectedCompetitionName = Contest::find($this->selectedCompetition)->name;
        $this->selectedCompetitionDate = Contest::find($this->selectedCompetition)->date;
        $this->series = Series::where('contest_id', $this->selectedCompetition)->get();
        $this->showFirstModal = false;
        $this->showSecondModal = true;

    }

    public function saveRegistration()
    {
        $user = auth()->user();

        if (empty($this->selectedSeries)) {
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'error',
                'html' => 'Selecteer ten minste één serie.',
            ]);
            return;
        }

        foreach($this->selectedSeries as $seriesId){
            $userSeries = new UserSeries;
            $userSeries->user_id = $user->id;
            $userSeries->subscription_date = now();
            $userSeries->series_id = $seriesId;
            $userSeries->save();
        }

        // Clear selected series
        $this->selectedSeries = [];

        $this->showSecondModal = false;
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De inschrijving van <b><i>{$user->user_name}</i></b> is opgeslaan",
        ]);
    }



    public function showUserSeries($groupId)
    {
        // Retrieve the group from the $groupBySeries collection based on the groupId
        $group = $this->groupBySeries->firstWhere('id', $groupId);

        $this->selectedUsername = $group->user->user_name;
        $this->selectedUserId = $group->user->id;
        $this->selectedStatusId = $group->status->id;
        $this->series = Series::all();

        if ($this->series->isEmpty()) {
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'error',
                'html' => 'Er zijn geen beschikbare series voor deze wedstrijd.',
            ]);
            return;
        }

        $this->showThirdModal = true;

    }

    public function validateRegistration()
    {
        // Update the UserSeries status and confirmation date
        $userSeries = UserSeries::where('user_id', $this->selectedUserId)
            ->where('status_id', $this->selectedStatusId)
            ->get();

        foreach ($userSeries as $series) {
            $series->status_id = 1; // Set the status_id to 2
            $series->confirmation_date = now(); // Set the confirmation date as the current date
            $series->save(); // Save the changes to the database
        }

        $this->loadGroupBySeries(); // Reload the $groupBySeries data

        $this->showThirdModal = false;
    }




    public function render()
    {
        $competitions = Contest::orderBy('name')
            ->get();

        return view('livewire.user.view-competitions', compact('competitions'))
            ->layout('layouts.zwemclub', [
                'description' => 'Manage the records of your vinyl shop',
                'title' => 'Manage competities',
            ]);
    }
}
