<?php namespace App\Http\Controllers\Sneakers;

use App\Enums\SortBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sneakers\SneakersRequest;
use App\Models\common\request\LogRequest;
use Illuminate\Database\Eloquent\Collection;
use App\Models\SneakersMagazine;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class SneakersController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function getList(): Collection
    {
        return SneakersMagazine::all();
    }

    public function getSortList(SortBy $sortBy): JsonResponse
    {
        return response()->json((new SneakersMagazine)->chooseSort($sortBy->name));
    }

    public function __invoke(SneakersRequest $request)
    {
        return $request->validated();
    }
}
