<?php namespace App\Http\Controllers\Stripes;

use App\Enums\SortBy;
use App\Http\Controllers\Controller;
use App\Models\Favorites\StripeFavorites;
use App\Models\Order\Order;
use App\Models\Order\OrderRepository;
use App\Models\Stripe\Stripe;
use App\Models\Stripe\StripeRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;


class StripesController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function getList(): Collection
    {
        return Stripe::all();
    }

    public function getSortList(SortBy $sortBy): JsonResponse
    {
        return response()->json((new StripeRepository())->chooseSort($sortBy->name));
    }

    public function getFavorites(): JsonResponse
    {
        return response()->json(StripeFavorites::all());
    }

    public function addFavorite(StripeFavorites $model): JsonResponse
    {
        StripeFavorites::updateOrInsert([
            'stripe_id' => $model->stripe_id,
        ], [
            'is_favorited' => true
        ]);

        return response()->json($model);
    }

    public function deleteFavorite(StripeFavorites $model): JsonResponse
    {
        $deleted = StripeFavorites::where('stripe_id', $model->stripe_id)->delete();

        return response()->json($deleted);
    }

    public function sendOrder(Order $model): JsonResponse
    {
//        OrderRepository::placingOrder($model);
        $model->sendOrder();

        if (!$model->hasErrors()) {

            return response()->json(["code" => 200, "message" => "Заказ оформлен. Скоро оператор с Вами свяжется."]);
        }

        return response()->json($model->getErrors());
    }
}
