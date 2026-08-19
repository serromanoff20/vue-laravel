<?php namespace App\Traits;

use App\Models\common\ErrorModel;

trait ErrorTrait
{
    private static array $errors = [];

    public function setError(string $placeError, string $textError): void
    {
        $error = new ErrorModel($placeError, $textError);

        self::$errors = array_merge(self::$errors, [$error]);
    }

    public function getErrors(): array
    {
        return self::$errors;
    }

    public function hasErrors(): bool
    {
        return !empty(self::$errors);
    }
}
