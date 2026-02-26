<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Category;

#[Layout('components.layout')]
#[Title('Category Management')]
class CategoryManager extends Component
{

  public $categories;
  public $newCategoryName = '';
  public $newCategoryDescription = '';
  public $successMessage = '';
  public $errorMessage = '';

  public function mount()
  {
    $this->categories = Category::with('user')->get()->collect();
  }

  // ! First thing tomorrow: What should happen if a category is self-deleted and we try to create a new category with the same name?
  public function addCategory()
  {
    $newCategory = Category::create([
      'user_id' => \Illuminate\Support\Facades\Auth::id(),
      'name' => $this->newCategoryName,
      'description' => $this->newCategoryDescription,
      'is_active' => true,
    ]);

    $this->categories->push($newCategory);
    $this->successMessage = 'Category added successfully!';
  }

  public function deleteCategory($categoryId)
  {
    $category = Category::find($categoryId);
    if ($category) {
      $category->delete();
      $this->categories = $this->categories->filter(fn($cat) => $cat->id !== $categoryId);
      $this->successMessage = 'Category deleted successfully!';
    } else {
      $this->errorMessage = 'Category not found.';
    }
  }

  public function render()
  {
    return view('livewire.category-manager');
  }
}
