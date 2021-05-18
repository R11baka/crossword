<?php

declare(strict_types=1);

namespace App\Crossword\Application\Response\Console;

interface ResponseInterface
{
    public function __invoke(string $message): void;
}
