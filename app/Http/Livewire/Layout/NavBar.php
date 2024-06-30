<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
class NavBar extends Component
{
//    protected $listeners = ['refresh-navigation-menu' => 'updateProfileInformation'];
//
//    public function updateProfileInformation()
//    {
//        $refresh = true;   // refresh the page when the 'refresh-navigation-menu' event is emitted
//    }

    public $avatar;
    protected $listeners = ['refresh-navigation-menu' => '$refresh'];
    public function render()
    {
        if (auth()->user()) {
            $this->avatar = 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->getFullNameAttribute());
            if (auth()->user()->profile_photo_path) {
                if (Storage::disk('public')->exists(auth()->user()->profile_photo_path))
                    $this->avatar = asset('storage/' . auth()->user()->profile_photo_path);
            }
        }
        return view('livewire.layout.nav-bar');
    }
}
