<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use App\Models\Location;
use App\Models\Sex;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Users extends Component
{
    use WithPagination;

    //public properties
    public $search;
    public $perPage = 5;
    public $loading = 'Even geduld, a.u.b. ...';
    public $sexes;
    public $locations;
    public $countries;

    //show or hide modal
    public $showModal = false;

    public $newUser =  [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'phone_number' => null,
        'federation_number' => null,
        'email' => null,
        'birth_date' => null,
        'start_date' => null,
        'password' => null,
        'is_admin' => false,
        'is_financial_administrator' => false,
        'is_coach' => false,
        'is_swimmer' => false,
        'sex_id' => null,
        'location_id' => null,
        'location_street' => null,
        'location_street_number' => null,
        'location_city' => null,
        'location_postal_code' => null,
        'location_country_id' => null,
    ];

    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        return [
            'newUser.first_name' => 'required',
            'newUser.last_name' => 'required',
            'newUser.federation_number' => 'required',
            'newUser.phone_number' => 'required',
            'newUser.email' => 'required',
            'newUser.birth_date' => 'required',
            'newUser.start_date' => 'required',
            'newUser.password' => 'required',
            'newUser.sex_id' => 'required',
            'newUser.location_street' => 'required',
            'newUser.location_street_number' => 'required',
            'newUser.location_city' => 'required',
            'newUser.location_postal_code' => 'required',
            'newUser.location_country_id' => 'required',

        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newUser.first_name' => 'voornaam',
        'newUser.last_name' => 'achternaam',
        'newUser.federation_number' => 'federatie nummer',
        'newUser.phone_number' => 'telefoonnummer',
        'newUser.email' => 'email',
        'newUser.birth_date' => 'geboorte dag',
        'newUser.start_date' => 'start datum',
        'newUser.password' => 'paswoord',
        'newUser.sex_id' => 'gender',
        'newUser.location_street' => 'straat',
        'newUser.location_street_number' => 'straat nummer',
        'newUser.location_city' => 'stad',
        'newUser.location_postal_code' => 'postcode',
        'newUser.location_country_id' => 'land',
    ];

    public function mount(){
        $this->sexes = Sex::orderBy('name')->get();
        $this->locations = Location::orderBy('name')->get();
        $this->countries = Country::orderBy('name')->get();
    }

    // set/reset $newUser and validation
    public function setNewUser(User $user = null)
    {
        $this->resetErrorBag();
        if ($user) {
            $this->newUser['id'] = $user->id;
            $this->newUser['first_name'] = $user->first_name;
            $this->newUser['last_name'] = $user->last_name;
            $this->newUser['phone_number'] = $user->phone_number;
            $this->newUser['federation_number'] = $user->federation_number;
            $this->newUser['email'] = $user->email;
            $this->newUser['birth_date'] = $user->birth_date;
            $this->newUser['start_date'] = $user->start_date;
            $this->newUser['password'] = $user->password;
            $this->newUser['is_admin'] = $user->is_admin;
            $this->newUser['is_coach'] = $user->is_coach;
            $this->newUser['is_swimmer'] = $user->is_swimmer;
            $this->newUser['is_financial_administrator'] = $user->is_financial_administrator;
            $this->newUser['sex_id'] = $user->sex_id;
            $this->newUser['is_active'] = $user->is_active;

            if ($user->location) {
                $this->newUser['location_street'] = $user->location->street;
                $this->newUser['location_street_number'] = $user->location->street_number;
                $this->newUser['location_city'] = $user->location->city;
                $this->newUser['location_postal_code'] = $user->location->postal_code;
                $this->newUser['location_country_id'] = $user->location->country_id;
            } else {
                // Set default values for location-related properties
                $this->newUser['location_street'] = null;
                $this->newUser['location_street_number'] = null;
                $this->newUser['location_city'] = null;
                $this->newUser['location_postal_code'] = null;
                $this->newUser['location_country_id'] = null;
            }
        } else {
            $this->reset('newUser');
        }
        $this->showModal = true;
    }


    // reset the paginator
//    public function updated($propertyName, $propertyValue)
//    {
//        $this->resetPage();
//    }

    // create a new user
    public function createUser()
    {
        $this->validate();
        $location = Location::create([
            'street' => $this->newUser['location_street'],
            'street_number' => $this->newUser['location_street_number'],
            'city' => $this->newUser['location_city'],
            'postal_code' => $this->newUser['location_postal_code'],
            'country_id' => $this->newUser['location_country_id'],
            // Add other location fields if necessary
        ]);

        $user = User::create([
            'first_name' => $this->newUser['first_name'],
            'last_name' => $this->newUser['last_name'],
            'phone_number' => $this->newUser['phone_number'],
            'federation_number' => $this->newUser['federation_number'],
            'email' => $this->newUser['email'],
            'birth_date' => $this->newUser['birth_date'],
            'start_date' => $this->newUser['start_date'],
            'password' => $this->newUser['password'],
            'sex_id' => $this->newUser['sex_id'],
            'is_admin' => isset($this->newUser['is_admin']),
            'is_coach' => isset($this->newUser['is_coach']),
            'is_swimmer' => isset($this->newUser['is_swimmer']),
            'is_financial_administrator' => isset($this->newUser['is_financial_administrator']),
            'location_id' => $location->id, // Assign the newly created location's ID to the user
            'is_active' => true
        ]);

        $this->showModal = false;

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker <b><i>{$user->user_name}</i></b> is toegevoegd",
        ]);
    }




    // update an existing user
    public function updateUser(User $user)
    {
        // Validate the input if necessary
         $this->validate();

        // Retrieve the location ID from the user object
        $locationId = $user->location_id;

        // Find the location by ID
        $location = Location::findOrFail($locationId);

        // Update the location with the new values
        $location->update([
            'street' => $this->newUser['location_street'],
            'street_number' => $this->newUser['location_street_number'],
            'city' => $this->newUser['location_city'],
            'postal_code' => $this->newUser['location_postal_code'],
            'country_id' => $this->newUser['location_country_id'],
            // Add other location fields if necessary
        ]);

        // Update the user with the new values
        $user->update([
            'first_name' => $this->newUser['first_name'],
            'last_name' => $this->newUser['last_name'],
            'phone_number' => $this->newUser['phone_number'],
            'federation_number' => $this->newUser['federation_number'],
            'email' => $this->newUser['email'],
            'birth_date' => $this->newUser['birth_date'],
            'start_date' => $this->newUser['start_date'],
            'password' => $this->newUser['password'],
            'sex_id' => $this->newUser['sex_id'],
            'is_admin' => $this->newUser['is_admin'],
            'is_coach' => $this->newUser['is_coach'],
            'is_swimmer' => $this->newUser['is_swimmer'],
            'is_financial_administrator' => $this->newUser['is_financial_administrator'],
            'is_active' => $this->newUser['is_active'],
            'location_id' => $locationId, // Assign the location ID to the user

        ]);


        // Close the modal
        $this->showModal = false;

        // Display a success toast
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker <b><i>{$user->user_name}</i></b> is bijgewerkt",
        ]);
    }












    // delete an existing user
    public function deleteUser(User $user)
    {
        $user->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The user <b><i>{$user->first_name }{$user->last_name }</i></b> has been deleted",
        ]);

    }

    /**  Add additional attributes that do not have a corresponding column in your database */

    public function render()
    {
        //convert the
        //setlocale(LC_TIME, 'nl_BE.UTF-8');
//        $formattedDate =

        $query = User::orderBy('last_name')->orderBy('first_name')
            ->searchLastNameOrFirstName($this->search);
        $users = $query->paginate($this->perPage);


        return view('livewire.admin.users', compact( 'users'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheer de gebruikers',
                'title' => 'Gebruikers beheren',
            ]);
    }
}
