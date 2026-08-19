<?php

namespace App\Models\Stripe;

use App\Helpers\Helpers;
use App\Models\common\ModelApp;
use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string name,
 * @property string model,
 * @property string description,
 * @property double cost,
 * @property string image,
 * @property boolean is_reserved,
 *
 */
class Stripe extends ModelApp
{
    use MigrationTableSchemaTrait;
    use HasFactory;

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
        'name',
        'model',
        'description',
        'cost',
        'image',
        'is_reserved',
    ];

    /**
     * Stripe constructor
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

    static public function sortTitle(string $name=''): Collection
    {
        if (!empty($name)) {
            return self::select()->whereRaw('LOWER(name) LIKE ?', [strtolower($name)])->orderBy('name', 'asc')->get();
        }
        return self::select()->orderBy('name', 'asc')->get();
    }

    static public function sortPriceDesc(string $name=''): Collection
    {
        if (!empty($name)) {
            return self::select()->whereRaw('LOWER(name) LIKE ?', [strtolower($name)])->orderBy('cost', 'desc')->get();
        }
        return self::select()->orderBy('cost', 'desc')->get();
    }

    static public function sortPriceAsc(string $name=''): Collection
    {
        if (!empty($name)) {
            return self::select()->whereRaw('LOWER(name) LIKE ?', [strtolower($name)])->orderBy('cost', 'asc')->get();
        }
        return self::select()->orderBy('cost', 'asc')->get();
    }
}
