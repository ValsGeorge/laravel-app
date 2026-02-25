<?php

use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public array $categories = [];

    public function add(): void
    {
        if (trim($this->name) === '') return;

        $this->categories[] = $this->name;
        $this->reset('name');
    }

    public function remove(int $index): void
    {
        unset($this->categories[$index]);
        $this->categories = array_values($this->categories);
    }
};

?>

<div class="w-full max-w-md bg-surface shadow-lg rounded-xl p-6 text-fg">

    <h2 class="text-2xl font-bold mb-4">Category Manager</h2>

    <div class="flex gap-2">
        <input
            type="text"
            wire:model="name"
            placeholder="Category name"
            class="flex-1 border border-surface-2 bg-bg rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent/40"
        />

        <button
            wire:click="add"
            class="bg-accent text-accent-contrast px-4 py-2 rounded-lg hover:opacity-90 transition"
        >
            Add
        </button>
    </div>

    <ul class="mt-4 space-y-2">
        @foreach($categories as $index => $category)
            <li class="flex justify-between items-center bg-surface-2 px-3 py-2 rounded-lg">
                <span>{{ $category }}</span>
                <button
                    wire:click="remove({{ $index }})"
                    class="text-accent hover:opacity-80"
                >
                    ✕
                </button>
            </li>
        @endforeach
    </ul>

</div>
