<?php

declare(strict_types=1);

namespace App\Crossword\Application\Response\API;

interface ResponseInterface
{
    public function body(): array;

    public function status(): int;
}
