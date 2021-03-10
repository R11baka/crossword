<?php

declare(strict_types=1);

namespace App\Dictionary\Domain\Enum;

/**
 * @todo https://wiki.php.net/rfc/enumerations
 */
final class ResponseStatus
{
    public const FAILED = 'failed';
    public const SUCCESS = 'success';
}
