<?php

use App\Http\Controllers\Stripes\StripesController;
use App\Models\Favorites\StripeFavorites;
use App\Models\Order\Order;
use App\Models\SneakersMagazine;
use App\Models\Stripe\StripeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sneakers\SneakersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Sneakers', 'prefix' => 'sneakers'], function () {
    Route::get('/sort-by/{sortBy}', [SneakersController::class, 'getSortList']);


    Route::get('/list', function (Request $request) {
        $sortBy = $request->query('sortBy');
        $title = $request->query('title') ?? '';

        return response()->json((new SneakersMagazine)->chooseSort($sortBy, $title));
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Stripes', 'prefix' => 'stripes'], function () {
//    Route::get('/sort-by/{sortBy}', [SneakersController::class, 'getSortList']);


    Route::get('/list', function (Request $request) {
        $sortBy = $request->query('sortBy');
        $name = $request->query('name') ?? '';

        return response()->json((new StripeRepository())->chooseSort($sortBy, $name));
    });

    Route::get('/favorites', [StripesController::class, 'getFavorites']);

    Route::post('/add-in-favorite', function (Request $request) {
        $controller = new StripesController();

        $params = $request->post('params');

        $model = new StripeFavorites(['stripe_id' => $params['stripeId']]);
        return $controller->addFavorite($model);
    });
    Route::delete('/delete-in-favorite', function (Request $request) {
        $controller = new StripesController();

        $stripeId = $request->query('stripeId');

        $model = new StripeFavorites(['stripe_id' => $stripeId]);
        return $controller->deleteFavorite($model);
    });

    Route::post('/send-order', function (Request $request) {
        $controller = new StripesController();
        $params = $request->post('params');

        $model = new Order(
            $params['mailForm'],
            $params['fioForm'],
            $params['order'],
        );
        return $controller->sendOrder($model);
    });
});
