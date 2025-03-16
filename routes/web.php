<?php

use App\Models\Product;
use App\Models\Subcategory;
use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\OnlineUsersController;
use App\Http\Controllers\POSUserInfoController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\userSidebarController;
use App\Http\Controllers\OnlineOrdersController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\AddPOSProductController;
use App\Http\Controllers\POS_OrderInfoController;
use App\Http\Controllers\ProductEditorController;
use App\Http\Controllers\UserSubCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('dashboard.welcomeAdmin');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/generate-invoice', function () {
        return response()->json(['invoiceNumber' => uniqid()]);
    });

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('quantity', QuantityController::class);
    Route::resource('product', ProductController::class);
    Route::resource('AddPOSProduct', AddPOSProductController::class);
    Route::resource('pos_userinfo', POSUserInfoController::class);
    Route::resource('pos_orderinfo', POS_OrderInfoController::class);
    Route::resource('users', UsersController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('role', RoleController::class);
    Route::resource('assignRole', AssignRoleController::class);
});

Route::get('subcategories/{category_id}', function ($category_id) {
    $subcategories = Subcategory::where('category_id', $category_id)->get();
    return response()->json($subcategories);
});

// Route::resource('pr', ProductEditorController::class);

// Route::get('/pr', function (ProductDataTable $datatable) {
// return $datatable->render('dashboard.product.view_product');
// });


Route::middleware('auth')->group(function () {



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// User Site Routes




Route::get('userSite', function () {
    return view('user_site.welcomeUser');
})->name('userSite');

Route::get('UserCategory/{id}', [UserCategoryController::class, 'index'])->name('UserCategory');
Route::get('UserSuCategory/{id}', [UserCategoryController::class, 'subindex'])->name('UserSuCategory');

Route::get('UserSCategory/{id}', [UserCategoryController::class, 'index2'])->name('UserSCategory');
Route::get('UserSubCategory/{id}', [UserCategoryController::class, 'Subcategory'])->name('UserSUbCategory');
Route::get('UserSubCategorySub/{id}', [UserSubCategoryController::class, 'sub'])->name('UserSubCategorySub');
Route::get('UserSubCategory/{id}', [UserSubCategoryController::class, 'index'])->name('UserSubCategory');
Route::get('UserSubCategoryProduct/{id}', [UserSubCategoryController::class, 'product'])->name('UserSubCategoryProduct');

Route::delete('/cartP/{email}', [EmailController::class, 'destroy'])->name('cartP.destroy');
Route::post('/cartP/update', [EmailController::class, 'update'])->name('cartP.update');



Route::middleware(['auth:user', 'verified'])->group(function () {
    route::resource('shoppingCart', ShoppingCartController::class);
});
route::resource('userProduct', UserProductController::class);
route::resource('contact', ContactController::class);
route::resource('checkout', CheckOutController::class);
route::resource('onlineOrders', OnlineOrdersController::class);
route::resource('contact', ContactController::class);
route::resource('cart', CartController::class);

// Email controllers


Route::controller(EmailController::class)->group(function () {

    Route::get('showw/{id}',  'Contactshow')->name('contact.show');

    Route::get('email',  'Contactemail')->name('contact.email');
    Route::get('orderemail',  'orderemail')->name('order.email');
});


require __DIR__ . '/auth.php';
