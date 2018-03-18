<?php
declare(strict_types=1);
namespace messanger\eventstore;

class Uuid
{
    /**
     * @var string
     */
    private $uuid;

    private function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function generate(): Uuid
    {
        return self::fromString(
            self::generateUuidString()
        );
    }

    public static function fromString(string $uuid): Uuid
    {
        self::ensureValidUuid($uuid);

        return new self($uuid);
    }

    public function asString(): string
    {
        return $this->uuid;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private static function ensureValidUuid(string $uuid): void
    {
        if ((preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid) === 0)) {
            throw new \InvalidArgumentException(
                'UUID has wrong format'
            );
        }
    }

    /**
     * @link http://www.php.net/manual/en/function.uniqid.php#94959
     */
    private static function generateUuidString(): string
    {
        return (string) sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}

