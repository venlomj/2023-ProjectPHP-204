<?php

namespace App\Http\Livewire\FinanceManager;

use App\Models\Measurement;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDocuments extends Component
{
    use WithPagination;

    public $search;
    public $users;
    public $products;
    public $amounts;
    public $size;

    public $perPage = 5;
    public $showModal = false;


    public $newOrderDocument = [
        'id' => null,
        'paid' => False,
        'user_id' => null,
        'order_period_id' => null,
    ];

    protected function rules()
    {
        return [
            'newOrderDocument.id' => 'required',
            'newOrderDocument.paid' => 'required',
            'newOrderDocument.user_id' => 'required',
            'newOrderDocument.order_period_id' => 'required',


        ];
    }

    protected $validationAttributes = [

        'newOrderDocument.id' => 'id',
        'newOrderDocument.paid' => 'paid',
        'newOrderDocument.user_id' => 'user id',
        'newOrderDocument.order_period_id' => 'order period',
    ];

    public function mount()
    {
        $this->products = Product::orderBy('name')->get();
        $this->orderline = Orderline::orderBy('product_id')->get();
        $this->measurement = Measurement::orderBy('name')->get();
    }


    public function setNewOrderDocument(Order $orderDocument = null)
    {
        $this->resetErrorBag();
        if ($orderDocument) {
            $this->newOrderDocument['id'] = $orderDocument->id;
            $this->newOrderDocument['paid'] = $orderDocument->id;
            $this->newOrderDocument['user_id'] = $orderDocument->id;


        } else {
            $this->reset('newOrderDocument');
        }
        $this->showModal = true;
    }

    public function createOrderDocument()
    {
//
        $orderDocument = Order::create([
            'paid' => $this->newOrderDocument['paid'],
            'user_id' => $this->newOrderDocument['user_id'],
            ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$orderDocument->id}</i></b> has been added",
        ]);

    }
    public function updateOrderDocument(Order $orderDocument)
    {
//
        $orderDocument->update([
            'id' => $this->newOrderDocument['id'],
            'paid' => $this->newOrderDocument['paid'],
            'user_id' => $this->newOrderDocument['user_id'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$orderDocument->id}</i></b> has been updated",
        ]);

    }

    // delete an existing record
    public function deleteOrderDocument(Order $orderDocument)
    {
        $orderDocument->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "The orderdocument <b><i>{$orderDocument->id}</i></b> has been deleted",
        ]);

    }
    public function render()
    {
        $orderDocuments = Product::orderBy('id')
            ->get();
        return view('livewire.finance-manager.order-documents', compact('orderDocuments'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheren van besteldocumenten',
                'title' => 'Bestellings documenten',
            ]);
    }
}

