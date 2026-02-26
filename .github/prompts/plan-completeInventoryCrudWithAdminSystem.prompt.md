# Plan: Complete Inventory CRUD with Admin System

You'll transform this into a production-ready inventory demo with admin-managed categories, full product CRUD, search capabilities, and dashboard analytics. This addresses the category blocker, adds missing CRUD operations, implements role-based access control, and includes impressive features like filtering and statistics that showcase your skills.

## Steps

### 1. Add admin role system

- Create migration to add `is_admin` boolean field to users table (default false)
- Update User model with `is_admin` cast and accessor methods
- Create admin middleware to check `Auth::user()->is_admin`
- Register middleware in bootstrap/app.php

### 2. Create authorization policies

- Generate ProductPolicy for verifying product ownership (view/update/delete own products)
- Generate CategoryPolicy for admin-only operations (create/update/delete requires `is_admin`)
- Register policies in AppServiceProvider

### 3. Seed database with global categories

- Create CategorySeeder with common inventory categories (Electronics, Furniture, Clothing, Food & Beverage, Office Supplies, etc.)
- Set `user_id` to null for global admin-managed categories (modify migration to make user_id nullable)
- Update DatabaseSeeder to call CategorySeeder and create one admin user
- Create factories for Product and Category for testing

### 4. Build admin category management

- Create `ManageCategories` Livewire component (admin-only, behind middleware)
- Implement full CRUD: list categories with edit/delete buttons, create form, inline editing
- Add route `/admin/categories` with `auth` and `admin` middleware
- Create blade view with table/form layout
- Add "Manage Categories" link in navbar (visible only to admins)

### 5. Complete product CRUD operations

- Create `ProductList` Livewire component to display user's products in responsive table/cards
- Add edit functionality: either inline editing or modal/separate page with `EditProduct` component
- Add delete functionality with confirmation (soft delete)
- Update Dashboard to show recent products added
- Create route for product listing page (e.g., `/products`)

### 6. Implement search and filtering

- Add search bar to ProductList (filter by name, SKU)
- Add category filter dropdown
- Add price range filter (min/max inputs)
- Add stock status filter (In Stock, Low Stock, Out of Stock)
- Use query strings for filter persistence

### 7. Add dashboard statistics

- Update Dashboard component with computed properties:
    - Total products count
    - Total inventory value (sum of price × stock_qty)
    - Low stock alerts (products with stock_qty < 10)
    - Products by category breakdown (chart data)
- Update dashboard view with stat cards and move product form to separate section

### 8. Fix data scoping issues

- Update Dashboard category dropdown to show only global categories (where `user_id` is null)
- Scope all product queries to current user: `Auth::user()->products()` instead of `Product::all()`
- Add authorization checks before edit/delete operations

### 9. Enhance models with relationships

- Add `products()` and `categories()` relationships to User model
- Add `user()` relationship to Product model
- Update Category to have nullable user relationship (global vs user-owned)

### 10. Polish UI/UX

- Add loading states for all Livewire actions
- Add confirmation modals for delete operations
- Add toast notifications for success/error messages
- Improve form validation feedback
- Add empty states ("No products yet" with CTA)

## Verification

- Run migrations fresh with seeding: `php artisan migrate:fresh --seed`
- Register as normal user → cannot access `/admin/categories` → can create/edit/delete own products → can only see global categories
- Create admin user in seeder → login as admin → can access category management → can CRUD categories
- Test product filtering and search functionality
- Verify dashboard statistics display correctly
- Check authorization: users cannot edit/delete other users' products

## Decisions

- **Categories**: Global, admin-only management. Database schema changes: `user_id` nullable on categories, null = global category
- **Admin system**: Boolean flag approach (`is_admin` field) - simple but effective for demo, easier than full RBAC
- **Scope**: Full CRUD with search/stats - showcases comprehensive Laravel/Livewire skills
