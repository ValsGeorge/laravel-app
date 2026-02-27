<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layout')]
#[Title('Admin Dashboard')]
class AdminPanel extends Component
{

  public function render()
  {
    return view('livewire.admin-panel');
  }
}
