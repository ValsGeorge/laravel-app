<nav class="bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100">
      <div class="container mx-auto px-2 py-2 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
          <img src="{{ asset('package-open-stroke-rounded.svg') }}" alt="" class="w-6 h-6" />
          <span class="hidden sm:inline font-bold text-xl"><span class="text-neutral-900 dark:text-neutral-100">Lara</span><span class="text-red-500">ventory</span></span>
        </a>
        <div class="flex items-center gap-4">
          <label class="inline-flex items-center gap-2 text-xs text-neutral-600 dark:text-neutral-400 cursor-pointer">
            <span>Theme</span>
            <span class="relative inline-block">
              <input id="theme-toggle" type="checkbox" class="sr-only peer" />
              <span class="block h-5 w-9 rounded-full bg-neutral-200 dark:bg-neutral-700 transition peer-checked:bg-red-500"></span>
              <span class="absolute left-0.5 top-0.5 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-4"></span>
            </span>
          </label>
          
          @if (Auth::check())
            <div class="flex flex-row">
              <p class="px-3 py-1.5 rounded-md text-xs font-medium text-neutral-700 dark:text-neutral-300 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition">Hello, {{ Auth::user()->name }}</p>
              <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1.5 rounded-md text-xs font-medium text-neutral-700 dark:text-neutral-300 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition">
                  Logout
                </button>
              </form>
            </div>

          @else
            <div class="flex flex-row">
              <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-md text-xs font-medium text-neutral-700 dark:text-neutral-300 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-700 transition">Login</a>
              <a href="{{ route('register') }}" class="px-3 py-1.5 rounded-md text-xs font-semibold bg-black dark:bg-white text-white dark:text-black hover:opacity-90 transition">Register</a>
            </div>
            @endif
          </div>
      </div>
  </nav>
