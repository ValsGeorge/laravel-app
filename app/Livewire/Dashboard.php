<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

use Livewire\WithPagination;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layout')]
#[Title('Dashboard')]
class Dashboard extends Component
{

    use WithPagination;

    public $productName = '';
    public $productQuantity = '';
    public $productCategory = '';
    public $productPrice = '';
    public $successMessage = '';
    public $errorMessage = '';

    public $editProductSuccessMessage = '';
    public $editProductErrorMessage = '';

    public $editingProductId = null;

    // Filter properties
    public $filterCategory = '';
    public $filterName = '';

    public $listeners = ['closeEditProductModal' => 'closeModal', 'productUpdate' => 'handleProductUpdated'];

    public function getProducts()
    {
        $query = Product::with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'user'
        ]);

        // Apply filters
        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        if ($this->filterName) {
            $query->where('name', 'like', '%' . $this->filterName . '%');
        }

        return $query->paginate(4);
    }

    public function resetFilters()
    {
        $this->filterCategory = '';
        $this->filterName = '';
        $this->resetPage();
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
            $this->resetPage();
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
        $this->editingProductId = null;
        $this->editProductSuccessMessage = 'Product updated successfully!';
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'products' => $this->getProducts(),
        ]);
    }
}
