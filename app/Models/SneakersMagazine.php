<?php namespace App\Models;

use App\Helpers\Helpers;
use App\Models\common\ModelApp;
use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class SneakersMagazine extends ModelApp
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    protected $guarded = false;

    /**
     * Следует ли обрабатывать временные метки модели.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Allow to create new rows in table
     * @var array
     */
    protected $fillable = [
        'title',
        'price',
        'image_url',
    ];

    /**
     * SneakersMagazine constructor
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fullNameClass = get_called_class();
        $lowerCase = Helpers::splitAndLowercase(class_basename($fullNameClass));
        $nameTable =  str_replace(" ", "_", $lowerCase);
//        $this->table = $this->setSchemeName($nameTable);
        $this->table = $nameTable;
    }

    public function chooseSort(string $sortBy, string $title=''): array
    {
        $result = match ($sortBy) {
            'priceAsc' => $this->sortPriceAsc($title),
            'priceDesc' => $this->sortPriceDesc($title),
            default => $this->sortTitle($title),
        };

        return $result->toArray();
    }

    public function sortTitle(string $title=''): Collection
    {
        if (!empty($title)) {
            return self::select()->whereRaw('LOWER(title) LIKE ?', [strtolower($title)])->orderBy('title', 'asc')->get();
        }
        return self::select()->orderBy('title', 'asc')->get();
    }

    public function sortPriceDesc(string $title=''): Collection
    {
        if (!empty($title)) {
            return self::select()->whereRaw('LOWER(title) LIKE ?', [strtolower($title)])->orderBy('price', 'desc')->get();
        }
        return self::select()->orderBy('price', 'desc')->get();
    }

    public function sortPriceAsc(string $title=''): Collection
    {
        if (!empty($title)) {
            return self::select()->whereRaw('LOWER(title) LIKE ?', [strtolower($title)])->orderBy('price', 'asc')->get();
        }
        return self::select()->orderBy('price', 'asc')->get();
    }
}
