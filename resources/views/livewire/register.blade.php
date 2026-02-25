<div class="flex items-center justify-center min-h-[calc(100vh-16rem)]">
  <div class="w-80 max-w-md">
    <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-8">
      <h2 class="text-2xl font-bold text-neutral-800 dark:text-neutral-100 mb-6 text-center">Register</h2>

      <form wire:submit.prevent="register">
        <div class="mb-4">
          <label for="name" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Name</label>
          <input type="text" id="name" wire:model="name" required
            class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
            placeholder="Enter your name">
          @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Email</label>
          <input type="email" id="email" wire:model="email" required
            class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
            placeholder="Enter your email">
          @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Password</label>
          <input type="password" id="password" wire:model="password" required
            class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
            placeholder="Enter your password">
          @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
          <label for="password_confirmation" class="block text-neutral-700 dark:text-neutral-300 text-sm font-medium mb-2">Confirm Password</label>
          <input type="password" id="password_confirmation" wire:model="password_confirmation" required
            class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 rounded-lg focus:outline-none focus:border-red-500"
            placeholder="Confirm your password">
          @error('password_confirmation') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition" wire:loading.attr="disabled" wire:target="register">
          <span wire:loading.remove wire:target="register">Register</span>
          <span wire:loading wire:target="register">Registering...</span>
        </button>
      </form>

      <p class="text-center text-neutral-600 dark:text-neutral-400 text-sm mt-4">
        Already have an account?
        {{-- <a href="{{ route('login') }}" class="text-red-500 hover:text-red-700 font-medium">Login here</a> --}}
      </p>
    </div>
  </div>
</div>
