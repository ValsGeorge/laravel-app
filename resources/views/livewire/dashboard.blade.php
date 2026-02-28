<div>
    <div class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Welcome to your Dashboard</h1>
        <p class="text-neutral-700 dark:text-neutral-300">This is where you can manage your inventory and view insights.
        </p>
    </div>

    <div class="flex flex-col mt-6 gap-4">
        {{-- Show the products from the database --}}

        <div name="title">Products</div>
        @if ($editProductSuccessMessage)
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-lg">
                {{ $editProductSuccessMessage }}
            </div>
        @endif
        @if ($editProductErrorMessage)
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 rounded-lg">
                {{ $editProductErrorMessage }}
            </div>
        @endif

        <div class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-2">Filter</h3>
            <div class="flex flex-row justify-between ">
                <div class="flex flex-row gap-4">
                    <div class="">
                        <label for="filterName"
                            class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Product
                            Name</label>
                        <input type="text" id="filterName" wire:model.live="filterName"
                            class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
                            placeholder="Enter product name">
                    </div>
                    <div class="">
                        <label for="filterCategory"
                            class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Category</label>
                        <select wire:model.live="filterCategory" id="filterCategory"
                            class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                            <option value="">Select category</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button wire:click="resetFilters"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition self-end ml-4">Reset
                    Filters</button>
            </div>
        </div>

        <div name="content" class="">
            @if ($products->count() > 0)
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($products as $product)
                        <div
                            class="group relative p-4 bg-white dark:bg-neutral-800 rounded shadow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">Name:
                                    {{ $product->name }}</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Category:
                                    @if ($product->category)
                                        {{ $product->category->name && !$product->category->trashed() ? $product->category->name : $product->category->old_name }}
                                        @if ($product->category->trashed())
                                            <span class="text-red-500 text-xs">(Archived)</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">Deleted Category</span>
                                    @endif
                                </p>
                            </div>

                            <span class="text-sm font-semibold text-neutral-700 dark:text-neutral-300">Quantity:
                                {{ $product->stock_qty }}</span>
                            <span class="text-sm font-semibold text-neutral-700 dark:text-neutral-300">Added on:
                                {{ $product->created_at->format('M d, Y') }}</span>
                            <span class="text-sm font-semibold text-neutral-700 dark:text-neutral-300">Added by:
                                {{ $product->user->name }}</span>
                            <span class="text-sm font-semibold text-red-500">Price:
                                ${{ number_format($product->price, 2) }}</span>

                            {{-- Hover overlay with edit and delete buttons --}}
                            @if ($product->user_id === auth()->id() || auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded flex items-start justify-end gap-3 p-4"
                                    style="background: rgba(0,0,0,0.2)">
                                    <button wire:click="editProduct({{ $product->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
                                        Edit
                                    </button>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        wire:confirm="Are you sure you want to delete this product?"
                                        class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition">
                                        Delete
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @else
                <p class="text-center text-neutral-600 dark:text-neutral-400">No products found.</p>
            @endif
        </div>


        <div class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-2 mt-6">Add New Product</h3>

            @if ($successMessage)
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-lg">
                    {{ $successMessage }}
                </div>
            @endif
            @if ($errorMessage)
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 rounded-lg">
                    {{ $errorMessage }}
                </div>
            @endif

            <form wire:submit.prevent="addProduct" class="bg-white dark:bg-neutral-800 p-4 rounded shadow">
                <div class="mb-4">
                    <label for="product-name"
                        class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Product
                        Name</label>
                    <input type="text" id="product-name" wire:model="productName"
                        class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
                        placeholder="Enter product name">
                    @error('productName')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="product-category"
                        class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Category</label>
                    <select id="product-category" wire:model="productCategory"
                        class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                        <option value="">Select category</option>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('productCategory')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="product-quantity"
                        class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Quantity</label>
                    <input type="number" id="product-quantity" wire:model="productQuantity"
                        class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
                        placeholder="Enter quantity">
                    @error('productQuantity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="product-price"
                        class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Price</label>
                    <input type="number" id="product-price" wire:model="productPrice"
                        class="w-full px-4 py-2 border  border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
                        placeholder="Enter price">
                    @error('productPrice')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition">Add
                    Product</button>
            </form>
        </div>
    </div>

    @if ($editingProductId)
        @livewire('edit-product-modal', ['editingProductId' => $editingProductId], key($editingProductId))
    @endif
