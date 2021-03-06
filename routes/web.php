<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/shop/{categorySlug}', CategoryComponent::class)->name('shop.category');
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/checkout', CheckoutComponent::class);
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/search', SearchComponent::class)->name('product.search');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


//? for user
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});


//? for admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('admin/category/add', AdminAddCategoryComponent::class)->name('admin.addCategory');
    Route::get('admin/category/edit/{categorySlug}', AdminEditCategoryComponent::class)->name('admin.editCategory');

    Route::get('admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.addProduct');
    Route::get('admin/product/edit/{productSlug}', AdminEditProductComponent::class)->name('admin.editProduct');

    Route::get('admin/slides', AdminHomeSliderComponent::class)->name('admin.homeSlider');
    Route::get('admin/slide/add', AdminAddHomeSliderComponent::class)->name('admin.addHomeSlider');
    Route::get('admin/slide/edit/{slideId}', AdminEditHomeSliderComponent::class)->name('admin.editHomeSlider');

    Route::get('admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homeCategories');
});
