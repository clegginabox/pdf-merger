<?php

declare(strict_types=1);

namespace Jmleroux\Tests;

use Jmleroux\PDFMerger\PDFMerger;
use PHPUnit\Framework\TestCase;

class PDFMergerTest extends TestCase
{
    /** @var string */
    private $resultDirectory;
    /** @var string */
    private $samplesDirectory;

    public function setUp(): void
    {
        $this->samplesDirectory = __DIR__ . '/pdfs/';
        $this->resultDirectory = __DIR__ . '/../var/';
    }

    public function testMergePdfs()
    {
        $pdf = new PDFMerger();

        $pdf->addPDF($this->samplesDirectory . 'github_1.pdf')
            ->addPDF($this->samplesDirectory . 'github_2.pdf')
            ->merge('file', $this->resultDirectory . 'test_github_1.pdf');

        $this->verifyResult('github_1_and_2.pdf', 'test_github_1.pdf');
    }

    private function verifyResult(string $original, string $result): void
    {
        $this->assertFileExists($this->resultDirectory . $result);

        $this->assertEquals(
            filesize($this->samplesDirectory . $original),
            filesize($this->resultDirectory . $result)
        );
    }
}
