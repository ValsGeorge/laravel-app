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
    public $errorMessage = '';

    public $editProductSuccessMessage = '';
    public $editProductErrorMessage = '';

    public $products = [];

    public $editingProductId = null;

    public $listeners = ['closeEditProductModal' => 'closeModal', 'productUpdate' => 'handleProductUpdated'];

    public function getProducts()
    {

        // Category is soft-deleted, so we need to include trashed categories in the query to have the old category name
        return Product::with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'user'
        ])->get();
    }

    public function addProduct()
    {
        try {
            // Validate input
            $this->validate([
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
            $this->errorMessage = 'Error: ' . $e->getMessage();
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            $this->successMessage = 'Product deleted successfully!';
        } catch (\Exception $e) {
            $this->errorMessage = 'Error deleting product: ' . $e->getMessage();
        }
    }

    public function editProduct($id)
    {
        $editingProduct = Product::find($id);
        if (! $editingProduct) {
            $this->errorMessage = 'Product not found.';
            return;
        }

        $this->editingProductId = $id;
    }

    public function closeModal()
    {
        $this->editingProductId = null;
    }

    public function handleProductUpdated()
    {
        $this->products = $this->getProducts();
        $this->editingProductId = null;
        $this->editProductSuccessMessage = 'Product updated successfully!';
    }

    public function render()
    {
        $this->products = $this->getProducts();
        return view('livewire.dashboard');
    }
}
