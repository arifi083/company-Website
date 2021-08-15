<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeSlideController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChangePass;
use App\Models\Multipic;



Route::get('/', function () {
    $brands=DB::table('brands')->get();
    $abouts=DB::table('home_abouts')->first();
    $images=Multipic::all();
    return view('home',compact('brands','abouts','images'));
});

//default route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
   // $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');

//Email verification 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// Category Controller  route
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);


 
//Brand Controller route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}',[BrandController::class,'Delete']);


//multi image route
Route::get('/multi/image/', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add/', [BrandController::class, 'StoreImg'])->name('store.image');

Route::get('/user/logout/', [BrandController::class, 'Logout'])->name('user.logout');


//admin all route  ,,, slider route
Route::get('/home/slider/', [HomeSlideController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider/', [HomeSlideController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider/', [HomeSlideController::class, 'StoreSlider'])->name('store.slider');

//Home about route
Route::get('/home/about/', [HomeAboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about/', [HomeAboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about/', [HomeAboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}',[HomeAboutController::class, 'EditAbout']);
Route::post('/homeabout/update/{id}', [HomeAboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}',[HomeAboutController::class,'DeleteAbout']);


//portfolio route
Route::get('/portfolio', [HomeAboutController::class, 'Portfolio'])->name('portfolio');


// Amdin Contact Page Route 
Route::get('/admin/contact/', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');



//Home contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');


//Changes password and user profile
Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

//user profile 
Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');










