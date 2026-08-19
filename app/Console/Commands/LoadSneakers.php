<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Models\SneakersMagazine;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LoadSneakers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-sneakers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = json_decode(file_get_contents(__DIR__ . "/../../../handbook/items.json", 'r'), JSON_UNESCAPED_UNICODE);

        foreach ($data as $row) {
            if (isset($row['imageUrl'])) {
                $image_url = '/images' . $row['imageUrl'];
                $lowerCase = Helpers::splitAndLowercase('imageUrl');
                $row[str_replace(" ", "_", $lowerCase)] = $image_url;

                try {
                    $newModel = SneakersMagazine::create($row);

                    if ($newModel) {

                        echo json_encode($newModel, JSON_UNESCAPED_UNICODE) . "\n";
                    } else {

                        echo "Ошибка в " . $row['id'];
                        exit();
                    }
                } catch(QueryException $exception) {

                    echo $exception->getMessage();
                    exit();
                }
            } else {
                echo json_encode($row, JSON_UNESCAPED_UNICODE) . "\n";
            }
        }

        exit();
    }
}
