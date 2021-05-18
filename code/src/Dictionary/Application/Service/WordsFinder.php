<?php

declare(strict_types=1);

namespace App\Dictionary\Application\Service;

use App\Dictionary\Application\Exception\NotFoundWordException;
use App\Dictionary\Domain\Dto\WordDtoCollection;
use App\Dictionary\Domain\Exception\WordNotFoundInStorageException;
use App\Dictionary\Domain\Model\Mask;
use App\Dictionary\Domain\Repository\ReadWordsStorageInterface;
use Psr\Log\LoggerInterface;

final class WordsFinder
{
    private LoggerInterface $logger;
    private ReadWordsStorageInterface $wordsStorage;

    public function __construct(ReadWordsStorageInterface $readWordsStorage, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->wordsStorage = $readWordsStorage;
    }

    public function find(string $language, string $mask, int $limit): WordDtoCollection
    {
        try {
            return $this->wordsStorage->search($language, new Mask($mask), $limit);
        } catch (WordNotFoundInStorageException $exception) {
            $this->logger->error($exception->getMessage());

            throw new NotFoundWordException();
        }
    }
}
