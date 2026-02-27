<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layout')]
#[Title('Edit Product')]
class EditProductModal extends Component
{

  public $editingProductId;
  public $editingProductName = '';
  public $editingProductQuantity = '';
  public $editingProductCategory = '';
  public $editingProductPrice = '';

  public $errorMessage = '';

  public function mount($editingProductId)
  {
    $this->editingProductId = $editingProductId;
    $product = Product::findOrFail($editingProductId);
    $this->editingProductName = $product->name;
    $this->editingProductQuantity = $product->stock_qty;
    $this->editingProductCategory = $product->category_id;
    $this->editingProductPrice = $product->price;
  }

  protected function rules()
  {
    return [
      'editingProductName' => ['required', 'string', 'max:255'],
      'editingProductQuantity' => ['required', 'integer', 'min:1'],
      'editingProductCategory' => ['required', 'exists:categories,id'],
      'editingProductPrice' => ['required', 'numeric', 'min:0'],
    ];
  }

  public function updateProduct()
  {
    $this->validate();

    $product = Product::find($this->editingProductId);
    if (! $product) {
      $this->errorMessage = 'Product not found.';
      return;
    }
    $product->name = $this->editingProductName;
    $product->stock_qty = $this->editingProductQuantity;
    $product->category_id = $this->editingProductCategory;
    $product->price = $this->editingProductPrice;
    $product->save();

    $this->dispatch('productUpdate');
  }

  public function render()
  {
    return view('livewire.edit-product-modal');
  }
}
