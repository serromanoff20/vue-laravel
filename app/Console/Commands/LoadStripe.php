<?php namespace App\Console\Commands;

use App\Models\Stripe\Stripe;
use App\Models\Stripe\StripeRepository;
use Illuminate\Console\Command;

class LoadStripe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-stripe {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loading goods from csv-file that is has props: название, модель, описание, стоимость, рис';

    /**
     * Execute the console command.
     */
    public function handle(Stripe $stripe): void
    {
        $filename = $this->argument('filename');

        $data = [];
        if (($handle = fopen(__DIR__ . "/../../../handbook/" . $filename, "r")) !== FALSE) {
            $header = fgetcsv($handle, 1000, ';');

            if ($header !== false) {
                $expectedHeaders = ['название', 'модель', 'описание', 'стоимость', 'рис'];

                if ($header !== $expectedHeaders) {
                    $this->error("Неверный формат заголовков CSV файла.");
                    fclose($handle);
                    return;
                }

                while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
                    $data = array_combine($header, $row);

                    $stripe->insert([
                        'name' => $data['название'],
                        'model' => $data['модель'],
                        'description' => $data['описание'],
                        'cost' => (float)$data['стоимость'],
                        'image' => '/images/stripes/' . $data['рис'] . '.jpg',
                    ]);
                }
                fclose($handle);
            }
        }

        print_r($data);
    }
}
