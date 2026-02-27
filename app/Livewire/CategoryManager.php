<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layout')]
#[Title('Category Management')]
class CategoryManager extends Component
{
  public $categories;
  public $newCategoryName = '';
  public $newCategoryDescription = '';
  public $successMessage = '';
  public $errorMessage = '';

  public $editingCategoryId = null;
  public $editCategoryName = '';
  public $editCategoryDescription = '';

  public function mount()
  {
    $this->categories = Category::with('user')->get();
  }

  protected function rules()
  {
    return [
      'newCategoryName' => [
        'required',
        'string',
        'max:255',
        // Unique only among NOT deleted categories
        Rule::unique('categories', 'name')->whereNull('deleted_at'),
      ],
      'newCategoryDescription' => ['nullable', 'string', 'max:2000'],
    ];
  }

  public function addCategory()
  {
    $this->resetMessages();

    $this->newCategoryName = trim($this->newCategoryName);

    $this->validate();

    $newCategory = Category::create([
      'user_id' => Auth::id(),
      'name' => $this->newCategoryName,
      'description' => $this->newCategoryDescription ?: null,
      'is_active' => true,
    ]);

    $this->categories->push($newCategory);

    $this->successMessage = 'Category added successfully!';
    $this->newCategoryName = '';
    $this->newCategoryDescription = '';
  }

  public function deleteCategory($categoryId)
  {
    $this->resetMessages();

    $category = Category::find($categoryId);

    if (! $category) {
      $this->errorMessage = 'Category not found.';
      return;
    }

    $deletedName = 'deleted_' . Str::random(8) . '_' . now()->format('YmdHis');
    $category->old_name = $category->name;
    $category->name = $deletedName;
    $category->save();

    $category->delete();

    $this->categories = $this->categories->reject(fn($cat) => $cat->id === (int) $categoryId);

    $this->successMessage = 'Category deleted successfully!';
  }

  private function resetMessages()
  {
    $this->successMessage = '';
    $this->errorMessage = '';
  }

  public function render()
  {
    return view('livewire.category-manager');
  }
}
