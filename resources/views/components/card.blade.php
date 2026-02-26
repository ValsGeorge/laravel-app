<div class="bg-white dark:bg-neutral-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-neutral-200 dark:border-neutral-700 overflow-hidden">
  @if(isset($title))
    <div class="px-6 py-4">
      <h2 class="text-xl font-bold text-white">{{ $title }}</h2>
    </div>
  @endif
  
  <div class="p-6">
    @if(isset($content))
      {{ $content }}
    @else
      {{ $slot }}
    @endif
  </div>
</div>