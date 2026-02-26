<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layout')]
#[Title('Admin Dashboard')]
class Admin extends Component
{

  public $users = [];

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

  public function isAdmin()
  {
    return $this->role === 'admin';
  }


  public function render()
  {
    return view('livewire.admin');
  }
}
