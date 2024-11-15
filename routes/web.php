<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\BooktableController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BookingBotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GoogleReviewsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TwilioController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/calendar', [DashboardController::class, 'calendar'])->name(
    'calendar'
);

Route::get('/analytics', function () {
    return view('analytics');
});

Route::get('/activities', function () {
    return view('activities');
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::middleware(['auth'])->group(function () {
    // These are routes that require authentication
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name(
        'dashboard'
    );
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name(
        'analytics'
    );

    Route::post('book-order', [BooktableController::class, 'store'])->name(
        'book-order'
    );
    Route::get('reservation-list', [BooktableController::class, 'list'])->name(
        'reservation-list'
    );
    Route::post('reservation-list', [BooktableController::class, 'list'])->name(
        'search_bar_route'
    );

    Route::get('customers-list', [
        BooktableController::class,
        'customerlist',
    ])->name('customers-list');
    Route::post('/order-list', 'BooktableController@update')->name(
        'update.status'
    );

    Route::post('accept-booking', [
        BooktableController::class,
        'acceptBooking',
    ])->name('settings-list');
    Route::post('cancel-booking', [
        BooktableController::class,
        'cancelBooking',
    ])->name('cancel-booking');
    Route::get('/reservation/{id}', [BooktableController::class, 'show']);

    Route::get('/record/{id}', [BooktableController::class, 'editor']);

    Route::post('/update-record', [BooktableController::class, 'update']);

    //Settings
    Route::get('set-list', [SettingController::class, 'index'])->name(
        'set-list'
    );
    Route::post('set-list', [SettingController::class, 'store'])->name(
        'set-list-store'
    );
});

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('forget-password', [
        ForgotPasswordController::class,
        'showForgetPasswordForm',
    ])->name('forget.password.get');
    Route::post('forget-password', [
        ForgotPasswordController::class,
        'submitForgetPasswordForm',
    ])->name('forget.password.post');
    Route::get('reset-password/{token}', [
        ForgotPasswordController::class,
        'showResetPasswordForm',
    ])->name('reset.password.get');
    Route::post('reset-password', [
        ForgotPasswordController::class,
        'submitResetPasswordForm',
    ])->name('reset.password.post');
});

Route::group(['prefix' => 'reservation-list'], function () {
    Route::get('/todaysrecord', [
        BooktableController::class,
        'getTodayRecords',
    ])->name('todaysrecord');
});

//clear cache route
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('optimize:clear');
    //$exitCode = Artisan::call('route:list');
    $output = Artisan::output();
    echo ":::Artisan Executed:::";
    echo "<pre>";
    print_r($output);
    echo "</pre>";
    exit();
    return "Cache is cleared";
});

// google reviews controller route
Route::get('/google-reviews', [GoogleReviewsController::class, 'index']);

// google reviews in dashboard button
// Route::get('/reviews', [ReviewController::class, 'fetchReviews'])->name(
//     'reviews.index'
// );

// dummy google review 
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// trip advisor 
Route::get('/trip-advisor', [ReviewController::class, 'index'])->name('trip-advisor');

// whatsapp page
Route::get('/whatsapp', function () {
    return view('whatsapp');
})->name('whatsapp');


Route::post('/send-whatsapp', [TwilioController::class, 'sendWhatsApp'])->name('send.whatsapp');

Route::post('/whatsapp', [BookingBotController::class, 'handleIncomingMessage']);

// Route::post('/reviews/reply/{id}', [ReviewController::class, 'updateReply'])->name('reviews.reply');


// sidebar category and products setup routes
Route::get('/category', function () {
    return view('category/category');
})->name('category');

Route::get('/sub-category', function () {
    return view('category/subcategory');
})->name('sub.category');

// products

Route::get('/product-attributes', function () {
    return view('/product/attributes');
})->name('product.attributes');

Route::get('/product-addon', function () {
    return view('/product/addon');
})->name('product.addon');

Route::get('/product-add', function () {
    return view('/product/add');
})->name('product.add');

Route::get('/product-attributes', function () {
    return view('/product/attributes');
})->name('product.attributes');

Route::get('/product-list', function () {
    return view('/product/list');
})->name('product.list');

Route::get('/bulk-import', function () {
    return view('/product/import');
})->name('bulk.import');

Route::get('/bulk-export', function () {
    return view('/product/export');
})->name('bulk.export');

Route::get('/product-reviews', function () {
    return view('/product/reviews');
})->name('product.reviews');