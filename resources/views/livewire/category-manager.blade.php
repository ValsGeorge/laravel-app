<div>
    <h2 class="text-xl font-semibold mt-8 mb-2">Category Management</h2>

    {{-- table with categories and option to add new category at the bottom --}}

    <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-4">
        <table class="w-full table-fixed">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left w-1/4">ID</th>
                    <th class="px-4 py-2 text-left w-1/4">User ID</th>
                    <th class="px-4 py-2 text-left w-1/6">User Name</th>
                    <th class="px-4 py-2 text-left w-1/3">Category Name</th>
                    <th class="px-4 py-2 text-left w-1/3">Category Description</th>
                    <th class="px-4 py-2 text-left w-1/3">Created</th>
                    <th class="px-4 py-2 text-left w-1/3">Updated</th>
                    <th class="px-4 py-2 text-left w-1/3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $category->id }}</td>
                        <td class="px-4 py-2">{{ $category->user_id }}</td>
                        <td class="px-4 py-2">{{ $category->user ? $category->user->name : 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $category->name }}</td>
                        <td class="px-4 py-2">{{ $category->description }}</td>
                        <td class="px-4 py-2">{{ $category->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $category->updated_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <button wire:click="editCategory({{ $category->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm transition">Edit</button>
                                <button wire:click="deleteCategory({{ $category->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            <form wire:submit.prevent="addCategory" class="mt-4 flex items-center space-x-2">
                <input type="text" wire:model="newCategoryName" placeholder="New category name"
                    class="w-1/4 px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                <input type="text" wire:model="newCategoryDescription" placeholder="New category description"
                    class="w-3/4 px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500">
                @error('newCategoryName')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm transition">Add New
                    Category</button>
            </form>
        </div>
    </div>
</div>
