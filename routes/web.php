<?php

use App\Http\Controllers\Admin\ClearCacheController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
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

require __DIR__ . '/admin/web.php';
require __DIR__ . '/user/web.php';
require __DIR__ . '/botman.php';

//activate and deactivate Online Trader
Route::any('/activate', function () {
	return view('activate.index', [
		'settings' => Settings::where('id', '1')->first(),
	]);
});

Route::get('register-license', [ClearCacheController::class, 'saveLicense']);

Route::any('/revoke', function () {
	return view('revoke.index');
});

Route::post('/reset-password', [NewPasswordController::class, 'store'])
	->middleware(['guest:' . config('fortify.guard')])
	->name('password.update');

//cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');
//Front Pages Route
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('terms', [HomePageController::class, 'terms'])->name('terms');
Route::get('privacy', [HomePageController::class, 'privacy'])->name('privacy');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('faq', [HomePageController::class, 'faq'])->name('faq');
Route::get('insurance', [HomePageController::class, 'insurance'])->name('insurance');
Route::get('regulations', [HomePageController::class, 'regulations'])->name('regulations');
Route::get('security', [HomePageController::class, 'security'])->name('security');
Route::get('master-account', [HomePageController::class, 'masterAccount'])->name('masterAccount');


// Product Landing Pages
Route::get('products/option-copy', [HomePageController::class, 'optionCopy'])->name('product.optionCopy');
Route::get('products/advance-trading', [HomePageController::class, 'advanceTrading'])->name('product.advanceTrading');
Route::get('products/live-trading', [HomePageController::class, 'liveTrading'])->name('product.liveTrading');
Route::get('products/futures', [HomePageController::class, 'futuresTrading'])->name('product.futures');
Route::get('products/options', [HomePageController::class, 'optionsTrading'])->name('product.options');
Route::get('products/binary', [HomePageController::class, 'binaryTrading'])->name('product.binary');
Route::get('products/spot', [HomePageController::class, 'spotTrading'])->name('product.spot');
Route::get('products/mirroring', [HomePageController::class, 'expertMirroring'])->name('product.mirroring');
Route::get('products/strategy', [HomePageController::class, 'strategyMarketplace'])->name('product.strategy');
Route::get('products/forex', [HomePageController::class, 'forexTrading'])->name('product.forex');


