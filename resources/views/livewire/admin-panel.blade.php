<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>


    {{-- User management section --}}
    <div class="mt-6">
        @livewire('user-manager')
    </div>


    {{-- Category management section --}}
    <div class="mt-6">
        @livewire('category-manager')
    </div>
</div>
