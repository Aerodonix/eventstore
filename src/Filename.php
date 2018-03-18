<?php
declare(strict_types=1);

namespace messanger\eventstore;

class Filename
{
    /**
     * @var string
     */
    private $filename;

    private function __construct(string $filename)
    {
        $this->isValid($filename);
        $this->filename = $filename;
    }

    public static function fromString(string $name): Filename
    {
        return new self($name);
    }

    public function asString(): string
    {
        return $this->filename;
    }

    /**
     * @throws \Exception
     */
    private function isValid(string $filename): void
    {
        if ($filename === '') {
            throw new \Exception('Filename can not be empty');
        }
    }
}
