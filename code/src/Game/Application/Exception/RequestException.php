<?php

declare(strict_types=1);

namespace App\Game\Application\Exception;

use RuntimeException;

final class RequestException extends RuntimeException
{
    public static function missingRequest(): self
    {
        return new self('Not found current request.');
    }
}