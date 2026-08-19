<?php namespace App\Models\Order;

use App\Mail\OrderShipped;
use App\Models\common\ModelApp;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\InvalidArgumentException;
use Exception;

class Order extends ModelApp
{
    const TO_ADMIN_EMAIL = "serromanoff2015@yandex.ru";

    public string $fromEmail;
    public string $fromNameUser;
    public array $dataOrder;

    /**
     * @param string $fromEmail
     * @param string $fromNameUser
     * @param string $jsonData
     */
    public function __construct(string $fromEmail, string $fromNameUser, string $jsonData)
    {
        $this->fromEmail = $fromEmail;
        $this->fromNameUser = $fromNameUser;
        $this->dataOrder = json_decode($jsonData, true);
    }

    public function sendOrder(): void
    {
        try {
            Mail::to(self::TO_ADMIN_EMAIL)->send(new OrderShipped($this));
        } catch (InvalidArgumentException | Exception $exception) {
            $this->setError(get_called_class(), $exception->getMessage());
        }
    }
}
