<?php

namespace App\Http\Livewire\Admin;

use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;
    public $productTypes;
    public $measures;
    public $search;
    public $perPage = 5;
    public $showModal = false;

    public $newProduct = [
        'id' => null,
        'name' => null,
        'measurement_id' => null,
        'product_type_id' => null,
        'is_active' => null,


    ];

    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        return [
            'newProduct.name' => 'required',
            'newProduct.measurement_id' => 'required',
            'newProduct.product_type_id' => 'required',
            'newProduct.is_active' => 'required'
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newProduct.name' => 'Product',
        'newProduct.measurement_id' => 'Maat'
    ];


    public function mount()
    {
        $this->productTypes = ProductType::orderBy('name')->get();
        $this->measures = Measurement::orderBy('id')->get();
    }


    public function setNewProducts(Product $products = null)
    {
        $this->resetErrorBag();
        if ($products) {
            $this->newProduct['id'] = $products->id;
            $this->newProduct['name'] = $products->name;
            $this->newProduct['measurement_id'] = $products->measurement_id;
            $this->newProduct['product_type_id'] = $products->product_type_id;
            $this->newProduct['is_active'] = $products->is_active;

        } else {
            $this->reset('newProduct');
        }
        $this->showModal = true;
    }



    // create a new product
    public function createProducts()
    {
        $this->validate();
        $products = Product::create([
            'name' => $this->newProduct['name'],
            'measurement_id' => $this->newProduct['measurement_id'],
            'product_type_id' => $this->newProduct['product_type_id'],
            'is_active' => $this->newProduct['is_active'],
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het product <b><i>{$products->name}</i></b> is toegevoegd",
        ]);

    }

    // update an existing product
    public function updateProducts(Product $product)
    {
        $this->validate();
        $product->update([
            'name' => $this->newProduct['name'],
            'measurement_id' => $this->newProduct['measurement_id'],
            'product_type_id' => $this->newProduct['product_type_id'],
            'is_active' => $this->newProduct['is_active']
        ]);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het product <b><i>{$product->name}</i></b> is aangepast",
        ]);

    }

    // delete an existing product
    public function deleteProducts(Product $product)
    {
        $product->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'danger',
            'html' => "Het product <b><i>{$product->name}</i></b> is verwijderd",
        ]);

    }

    public function render()
    {
        $products = Product::orderBy('name')
            ->paginate($this->perPage);
        return view('livewire.admin.products', compact('products'))
            ->layout('layouts.zwemclub', [
                'description' => 'Beheer van producten',
                'title' => 'Producten beheren',
            ]);
    }


}
