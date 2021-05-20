<?php

declare(strict_types=1);

namespace App\Tests\Dictionary\Features\PopulateStorage\Upload;

use App\Dictionary\Features\PopulateStorage\Upload\FileAssert;
use RuntimeException;
use App\Tests\Dictionary\DictionaryTestCase;

/**
 * @coversDefaultClass \App\Dictionary\Features\PopulateStorage\Upload\FileAssert
 */
final class FileAssertTest extends DictionaryTestCase
{
    /**
     * @covers ::assertFile
     */
    public function testSuccessfullyAssertFile(): void
    {
        FileAssert::assertFile(tempnam(sys_get_temp_dir(), 'test_'));

        self::assertTrue(true);
    }

    /**
     * @covers ::assertFile
     */
    public function testThrowExceptionWhenFileIsNotFound(): void
    {
        $this->expectException(RuntimeException::class);

        FileAssert::assertFile('/asf/test_file.txt');
    }

    /**
     * @covers ::assertCsvFile
     */
    public function testSuccessfullyAssertFileType(): void
    {
        FileAssert::assertCsvFile($this->createTempFile('.csv', ['test']));

        self::assertTrue(true);
    }
}
