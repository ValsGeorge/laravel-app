<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layout')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public $productName = '';
    public $productQuantity = '';
    public $productCategory = '';
    public $productPrice = '';
    public $successMessage = '';

    public function addProduct()
    {
        try {
            // Validate input
            $validated = $this->validate([
                'productName' => 'required|string|max:255',
                'productQuantity' => 'required|integer|min:1',
                'productCategory' => 'required|exists:categories,id',
                'productPrice' => 'required|numeric|min:0',
            ]);

            // Save to the database
            Product::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'name' => $this->productName,
                'stock_qty' => $this->productQuantity,
                'category_id' => $this->productCategory,
                'price' => $this->productPrice,
                'sku' => \Illuminate\Support\Str::slug($this->productName) . '-' . time(),
            ]);

            // Clear the form
            $this->reset(['productName', 'productQuantity', 'productCategory', 'productPrice']);

            // Show success message
            $this->successMessage = 'Product added successfully!';
        } catch (\Exception $e) {
            $this->successMessage = 'Error: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
