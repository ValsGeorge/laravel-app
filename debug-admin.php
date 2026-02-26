<?php

// Artisan tinker commands to debug admin role
// Run these one by one using: php artisan tinker

// 1. Check current user's role
\App\Models\User::find(auth()->id())?->role;

// 2. Check ALL users and their roles
\App\Models\User::all(['id', 'name', 'email', 'role'])->toArray();

// 3. Check if admin user exists
\App\Models\User::where('role', 'admin')->get(['id', 'name', 'email', 'role'])->toArray();

// 4. Check .env admin credentials
echo "ADMIN_EMAIL: " . env('ADMIN_EMAIL') . "\n";
echo "ADMIN_NAME: " . env('ADMIN_NAME') . "\n";

// 5. Check if migration ran
\Illuminate\Support\Facades\Schema::hasColumn('users', 'role');
