<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Sprovider\SproviderDashboardComponent;
use App\Http\Livewire\Sprovider\SproviderProfileComponent;
use App\Http\Livewire\Sprovider\SproviderEditProfileComponent;
use App\Http\Livewire\Sprovider\SproviderRequestComponent;
use App\Http\Livewire\Customer\CustomerDashboardComponent;
use App\Http\Livewire\Customer\CustomerRequestComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminEditServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminServiceProvidersComponent;
use App\Http\Livewire\ServcieCategoriesComponent;
use App\Http\Livewire\ServicesByCategoryComponent;
use App\Http\Livewire\ServiceDetailsComponent;
use App\Http\Livewire\ChangeLocationComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\TermOfUseComponent;
use App\Http\Livewire\PrivacyComponent;
use App\Http\Livewire\FaqComponent;
use App\Http\Livewire\ChooseServiceProviderComponent;
use App\Http\Livewire\Admin\AdminServicesComponent;
use App\Http\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Http\Livewire\Admin\AdminAddServicesComponent;
use App\Http\Livewire\Admin\AdminEditServicesComponent;
use App\Http\Livewire\Admin\AdminSliderComponent;
use App\Http\Livewire\Admin\AdminAddSlideComponent;
use App\Http\Livewire\Admin\AdminEditSlideComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Controllers\SearchController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',HomeComponent::class)->name('home');

Route::get('/service-categories',ServcieCategoriesComponent::class)->name('home.service_categories');
Route::get('/{category_slug}/services',ServicesByCategoryComponent::class)->name('home.services_by_category');
Route::get('/service/{service_slug}',ServiceDetailsComponent::class)->name('home.service_details');
Route::get('/choose-sprovider/{service_id}',ChooseServiceProviderComponent::class)->name('home.choose_sprovider');

Route::get('/autocomplete',[SearchController::class,"autocomplete"])->name('autocomplete');
Route::get('/search',[SearchController::class,"searchServcies"])->name('searchServices');

Route::get('/change-location',ChangeLocationComponent::class)->name('home.change_location');
Route::get('/about-us',AboutComponent::class)->name('home.about');
Route::get('/contact-us',ContactComponent::class)->name('home.contact');
Route::get('/faq',FaqComponent::class)->name('home.faq');
Route::get('/term-of-use',TermOfUseComponent::class)->name('home.term_of_use');
Route::get('/privacy',PrivacyComponent::class)->name('home.privacy');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/customer/dashboard',CustomerDashboardComponent::class)->name('customer.dashboard');
    Route::get('/customer/{user_id}/requests',CustomerRequestComponent::class)->name('customer.requests');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authsprovider'
])->group(function () {
    Route::get('/sprovider/dashboard',SproviderDashboardComponent::class)->name('sprovider.dashboard');
    Route::get('/sprovider/profile',SproviderProfileComponent::class)->name('sprovider.profile');
    Route::get('/sprovider/profile/edit',SproviderEditProfileComponent::class)->name('sprovider.edit_profile');
    Route::get('/sprovider/{user_id}/requests',SproviderRequestComponent::class)->name('sprovider.requests');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authadmin'
])->group(function () {
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/service-categories',AdminServiceCategoryComponent::class)->name('admin.service_categories');
    Route::get('/admin/service-categories/add',AdminAddServiceCategoryComponent::class)->name('admin.add_service_categories');
    Route::get('/admin/service-categories/edit/{category_id}',AdminEditServiceCategoryComponent::class)->name('admin.edit_service_categories');
    Route::get('/admin/all-services',AdminServicesComponent::class)->name('admin.all_services');
    Route::get('/admin/{category_slug}/services',AdminServicesByCategoryComponent::class)->name('admin.services_by_category');
    Route::get('/admin/services/add',AdminAddServicesComponent::class)->name('admin.add_services');
    Route::get('/admin/services/edit/{service_slug}',AdminEditServicesComponent::class)->name('admin.edit_services');

    Route::get('/admin/slider',AdminSliderComponent::class)->name('admin.slider');
    Route::get('/admin/slide/add',AdminAddSlideComponent::class)->name('admin.add_slide');
    Route::get('/admin/slide/edit/{slide_id}',AdminEditSlideComponent::class)->name('admin.edit_slide');

    Route::get('/admin/contacts',AdminContactComponent::class)->name('admin.contacts');

    Route::get('/admin/service-providers',AdminServiceProvidersComponent::class)->name('admin.service_providers');
});
