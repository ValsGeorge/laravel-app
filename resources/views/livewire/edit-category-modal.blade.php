<div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm" style="background: rgba(0,0,0,0.7)"
    wire:click="$dispatch('closeEditCategoryModal')">
    <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-4 w-full max-w-md mx-auto" @click.stop>
        <h2 class="text-xl font-semibold mb-4">Edit Category</h2>
        <form wire:submit.prevent="updateCategory" class="space-y-4">
            <div>
                <label for="categoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category
                    Name</label>
                <input type="text" id="categoryName" wire:model="editingCategoryName" required
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                @error('editingCategoryName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="categoryDescription"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Description</label>
                <textarea id="categoryDescription" wire:model="editingCategoryDescription" rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"></textarea>
                @error('editingCategoryDescription')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" wire:click="$dispatch('closeEditCategoryModal')"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm transition">Cancel</button>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm transition">Update
                    Category</button>
            </div>
        </form>
    </div>
</div>
