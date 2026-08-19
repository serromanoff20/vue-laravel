<?php namespace App\Models\Favorites;

use App\Helpers\Helpers;
use App\Models\common\ModelApp;
use App\Traits\MigrationTableSchemaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int id
 * @property int stripe_id
 * @property boolean is_favorited
 * @property string|null user_id
 * @property int created_at
 * @property int updated_at
 *
 */
class StripeFavorites extends ModelApp
{
    use MigrationTableSchemaTrait;
    use HasFactory;

    /**
     * Следует ли обрабатывать временные метки модели.
     * @var bool
     */
    public $timestamps = true;

    /**
     * Allow to create new rows in table
     * @var array
     */
    protected $fillable = [
        'stripe_id',
        'is_favorited',
        'user_id',
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
}
