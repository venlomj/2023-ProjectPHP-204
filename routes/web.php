<?php


use App\Http\Livewire\Coach\Competitions;
use App\Http\Livewire\Coach\CompetitionStats;
use App\Http\Livewire\Admin\Genders;
use App\Http\Livewire\Coach\GiveSupplements;
use App\Http\Livewire\Coach\Locations;
use App\Http\Livewire\Admin\Distances;
use App\Http\Livewire\Admin\Parameters;
use App\Http\Livewire\Admin\Products;
use App\Http\Livewire\Admin\Strokes;
use App\Http\Livewire\Coach\Supplements;
use App\Http\Livewire\Coach\Trainings;
use App\Http\Livewire\Coach\TrainingsTypes;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\FinanceManager\DistributionDocuments;
use App\Http\Livewire\FinanceManager\OrderDocuments;
use App\Http\Livewire\User\ViewCompetitions;
use App\Models\Contest;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\Admin;
use App\Http\Livewire\Admin\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('calendar', CalendarController::Class)->name('calendar');
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('genders', Genders::class)->name('genders');
    Route::get('parameters', Parameters::class)->name('parameters');
    Route::get('users', Users::class)->name('users');
    Route::get('strokes', Strokes::class)->name('strokes');
    Route::get('distances', Distances::class)->name('distances');
});

Route::prefix('coach')->middleware('coach')->group(function () {
    Route::get('competitions', Competitions::class)->name('competitions');
    Route::get('competition-stats', CompetitionStats::class)->name('competition-stats');
    Route::get('supplements', Supplements::class)->name('supplements');
    Route::get('locations', Locations::class)->name('locations');
    Route::get('trainingsType', TrainingsTypes::class)->name('trainingsType');
    Route::get('trainings', Trainings::class)->name('trainings');
    Route::get('give-supplements', GiveSupplements::class)->name('give-supplements');
});


Route::prefix('finance-manager')->middleware('finance_manager')->group(function () {
    Route::get('order-documents', OrderDocuments::class)->name('order-documents');
    Route::get('distribution-documents', DistributionDocuments::class)->name('distribution-documents');
    Route::get('products', Products::class)->name('products');
});

Route::prefix('user')->group(function () {
    Route::get('view-competitions', ViewCompetitions::class)->name('view-competitions');
});

//Route::middleware(['auth', 'is_admin'])->prefix('is_admin')->name('is_admin.')->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    //Route::redirect('/', '/admin/users');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
