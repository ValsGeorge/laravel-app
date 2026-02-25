<?php

use Livewire\Component;

new class extends Component
{

    public $productName = '';
    public $productQuantity = '';
    public $productCategory = '';
    public $productPrice = '';

    public function addProduct()
    {
        // Validate input
        $this->validate([
            'productName' => 'required|string|max:255',
            'productQuantity' => 'required|integer|min:1',
            'productCategory' => 'matches:/^(electronics|clothing|home)$/',
            'productPrice' => 'required|numeric|min:0',
        ]);

        // Here you would typically save the product to the database
        // For this example, we'll just reset the form fields

        $this->reset(['productName', 'productQuantity', 'productCategory', 'productPrice']);

        // Optionally, you could emit an event or show a success message
    }
};
?>

<x-layout title="Dashboard">
    <div class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Welcome to your Dashboard</h1>
        <p class="text-neutral-700 dark:text-neutral-300">This is where you can manage your inventory and view insights.</p>
    </div>

    <div class="">
        <h3 class="text-xl font-semibold mb-2 mt-6">Add New Product</h3>
        <form wire:submit.prevent="addProduct" class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
            <div class="mb-4">
                <label for="product-name" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Product Name</label>
                <input type="text" id="product-name" wire:model="productName" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500" placeholder="Enter product name">
            </div>
            
            <div class="mb-4">
                <label for="product-category" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Category</label>
                <select id="product-category" wire:model="productCategory" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                    <option value="">Select category</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="home">Home</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="product-quantity" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Quantity</label>
                <input type="number" id="product-quantity" wire:model="productQuantity" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500" placeholder="Enter quantity">
            </div>

            <div class="mb-4">
                <label for="product-price" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Price</label>
                <input type="number" id="product-price" wire:model="productPrice" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500" placeholder="Enter price">
            </div>
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition">Add Product</button>
        </form>
    </div>
</x-layout>