<?php

namespace App\Http\Livewire\FinanceManager;

use App\Http\Livewire\Admin\Users;
use App\Models\Measurement;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\User;
use App\Models\UserSeries;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DistributionDocuments extends Component
{
    use WithPagination;

    public $search;
    public $users;
    public $products;
    public $amounts;
    public $size;

    public $perPage = 5;
    public $showModal = false;


    public $newDistributeDocument = [
        'id' => null,
        'paid' => False,
        'user_id' => null,
        'order_period_id' => null,
    ];

    protected function rules()
    {
        return [
            'newDistributeDocument.id' => 'required',
            'newDistributeDocument.paid' => 'required',
            'newDistributeDocument.user_id' => 'required',
            'newDistributeDocument.order_period_id' => 'required',


        ];
    }

    protected $validationAttributes = [

        'newDistributeDocument.id' => 'id',
        'newDistributeDocument.paid' => 'paid',
        'newDistributeDocument.user_id' => 'user id',
        'newDistributeDocument.order_period_id' => 'order period',
    ];

    public function mount()
    {
        $this->products = Product::orderBy('name')->get();
        $this->orderline = Orderline::orderBy('product_id')->get();
        $this->measurement = Measurement::orderBy('name')->get();
        $this->userseries = UserSeries::orderBy('id')->get();
        $this->users = User::orderBy('first_name')->get();


    }


    public function setNewDistributeDocument(Order $distributeDocument = null)
    {
        $this->resetErrorBag();
        if ($distributeDocument) {
            $this->newDistributeDocument['id'] = $distributeDocument->id;
            $this->newDistributeDocument['paid'] = $distributeDocument->paid;
            $this->newDistributeDocument['user_id'] = $distributeDocument->user_id;


        } else {
            $this->reset('newDistributeDocument');
        }
        $this->showModal = true;
    }

    public function createDistributeDocument()
    {
//
        $distributeDocument = Order::create([
            'paid' => $this->newDistributeDocument['paid'],
            'user_id' => $this->newDistributeDocument['user_id'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$distributeDocument->id}</i></b> has been added",
        ]);

    }
    public function updateDistributeDocument(Order $distributeDocument)
    {
//
        $distributeDocument->update([
            'id' => $this->newDistributeDocument['id'],
            'paid' => $this->newDistributeDocument['paid'],
            'user_id' => $this->newDistributeDocument['user_id'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$distributeDocument->id}</i></b> has been updated",
        ]);

    }

    // delete an existing record
    public function deleteDistributeDocument(Order $distributeDocument)
    {
        $distributeDocument->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$distributeDocument->id}</i></b> has been deleted",
        ]);

    }
public function render()
{
    /*$userId = auth()->user()->id;*/
    $userId = Auth::id();
    $distributeDocuments = User::orderby('id')
        ->where('users.id', '=', $userId)
        ->get();


    return view('livewire.finance-manager.distribution-documents', compact('distributeDocuments'))
        ->layout('layouts.zwemclub', [
            'description' => 'Beheren van verdeeldocumenten',
            'title' => 'Verdeel documenten',
        ]);
}
}


