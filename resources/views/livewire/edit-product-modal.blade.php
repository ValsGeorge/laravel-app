<div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm" style="background: rgba(0,0,0,0.7)"
    wire:click="$dispatch('closeEditProductModal')">
    <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-4 w-full max-w-md mx-auto" @click.stop>
        <h2 class="text-xl font-semibold mb-4">Edit Product</h2>
        <form wire:submit.prevent="updateProduct" class="space-y-4">
            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product
                    Name</label>
                <input type="text" id="productName" wire:model="editingProductName" required
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                @error('editingProductName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="productDescription"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Description</label>
                <textarea id="productDescription" wire:model="editingProductDescription" rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"></textarea>
                @error('editingProductDescription')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="productPrice" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product
                    Price</label>
                <input type="number" id="productPrice" wire:model="editingProductPrice" step="0.01" required
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                @error('editingProductPrice')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="productCategory" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product
                    Category</label>
                <select id="productCategory" wire:model="editingProductCategory"
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                    <option value="">Select category</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('editingProductCategory')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" wire:click="$dispatch('closeEditProductModal')"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm transition">Cancel</button>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm transition">Update
                    Product</button>
            </div>
        </form>
    </div>
</div>
