<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layout')]
#[Title('Admin Dashboard')]
class Admin extends Component
{

  public $users = [];
  public $successMessage = '';
  public $errorMessage = '';

  public $editingUserId = null;
  public $editName = '';
  public $editEmail = '';
  public $editRole = '';

  public function updateUserInfo($userId)
  {
    // Set the user being edited and populate the form
    $user = \App\Models\User::find($userId);
    if ($user) {
      $this->editingUserId = $userId;
      $this->editName = $user->name;
      $this->editEmail = $user->email;
      $this->editRole = $user->role ?? 'user';
    }
  }

  public function saveUserInfo($userId)
  {
    // Logic to save updated user information
    $user = \App\Models\User::find($userId);
    if ($user) {
      $user->name = $this->editName;
      $user->email = $this->editEmail;
      $user->role = $this->editRole;
      $user->save();
      $this->successMessage = 'User updated successfully!';
    }
    $this->cancelEdit();
    $this->users = $this->getUsers();
  }

  public function cancelEdit()
  {
    $this->editingUserId = null;
    $this->editName = '';
    $this->editEmail = '';
    $this->editRole = '';
  }

  public function mount()
  {
    $this->users = $this->getUsers();
  }
  public function getUsers()
  {
    return \App\Models\User::select('id', 'name', 'email', 'role', 'created_at')->get();
  }

  public function deleteUser($userId)
  {
    $user = \App\Models\User::find($userId);
    if ($user && $user->id !== Auth::id() && !$user->isAdmin()) {
      $user->delete();
      $this->successMessage = 'User deleted successfully!';
      $this->users = $this->getUsers();
    } else {
      $this->errorMessage = 'Cannot delete this user. You cannot delete yourself or another admin.';
    }
  }


  public function render()
  {
    return view('livewire.admin');
  }
}
