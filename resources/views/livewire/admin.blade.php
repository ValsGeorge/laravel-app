<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>


    {{-- User management section --}}
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">User Management</h2>

        @if ($successMessage)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ $successMessage }}</span>
            </div>
        @endif

        @if ($errorMessage)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ $errorMessage }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-4">
            <table class="w-full table-fixed">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left w-1/4">Name</th>
                        <th class="px-4 py-2 text-left w-1/4">Email</th>
                        <th class="px-4 py-2 text-left w-1/6">Role</th>
                        <th class="px-4 py-2 text-left w-1/3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            @if ($editingUserId === $user->id)
                                <td class="px-4 py-2">
                                    <input type="text" wire:model="editName" value="{{ $user->name }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="email" wire:model="editEmail" value="{{ $user->email }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                </td>
                                <td class="px-4 py-2">
                                    <select wire:model="editRole"
                                        class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100">
                                        <option value="user">User</option>
                                        <option value="moderator">Moderator</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button wire:click="saveUserInfo({{ $user->id }})"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm transition">Save</button>
                                        <button type="button" wire:click="cancelEdit"
                                            class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-sm transition">Cancel</button>
                                    </div>
                                </td>
                            @else
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->isAdmin() ? 'Admin' : 'User' }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button wire:click="updateUserInfo({{ $user->id }})"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm transition">Edit</button>
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">Delete</button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
