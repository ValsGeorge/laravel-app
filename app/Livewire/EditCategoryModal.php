<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;

#[Layout('components.layout')]
#[Title('Edit Category')]
class EditCategoryModal extends Component
{


  public $editingCategoryId;
  public $editingCategoryName = '';
  public $editingCategoryDescription = '';

  public $errorMessage = '';

  public function mount($editingCategoryId)
  {
    $this->editingCategoryId = $editingCategoryId;
    $category = Category::findOrFail($editingCategoryId);
    $this->editingCategoryName = $category->name;
    $this->editingCategoryDescription = $category->description;
  }

  protected function rules()
  {
    return [
      'editingCategoryName' => [
        'required',
        'string',
        'max:255',
        Rule::unique('categories', 'name')
          ->whereNull('deleted_at')
          ->ignore($this->editingCategoryId),
      ],
      'editingCategoryDescription' => ['nullable', 'string', 'max:2000'],
    ];
  }

  public function updateCategory()
  {
    $this->validate();

    $category = Category::find($this->editingCategoryId);
    if (! $category) {
      $this->errorMessage = 'Category not found.';
      return;
    }
    $category->name = $this->editingCategoryName;
    $category->description = $this->editingCategoryDescription ?: null;
    $category->save();

    // Emit event to refresh category list in original component
    $this->dispatch('categoryUpdated');
  }


  public function render()
  {
    return view('livewire.edit-category-modal');
  }
}
