<?php

declare(strict_types=1);

namespace App\Crossword\Infrastructure\HttpClient;

use Psr\Http\Message\ResponseInterface;

final class ResponseDataExtractor
{
    public function extract(ResponseInterface $response): array
    {
        $body = $response->getBody();

        return (array) json_decode($body->getContents(), true);
    }
}
