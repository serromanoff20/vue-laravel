<?php namespace App\Models\Stripe;

use App\Helpers\Helpers;
use Illuminate\Support\Collection;
use Exception;

class StripeRepository
{
    /**
     * @return Collection|Stripe[]
     */
    public static function listAll(): Collection|array
    {
        return Stripe::all();
    }

    public function chooseSort(string $sortBy, string $name=''): array
    {
        $result = match ($sortBy) {
            'priceAsc' => Stripe::sortPriceAsc($name),
            'priceDesc' => Stripe::sortPriceDesc($name),
            default => Stripe::sortTitle($name),
        };

        return $result->toArray();
    }
}
