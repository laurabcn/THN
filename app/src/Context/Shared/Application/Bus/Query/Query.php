<?php

declare(strict_types=1);

namespace App\Context\Shared\Application\Bus\Query;

use InvalidArgumentException;

abstract class Query
{
    private const MESSAGE_TYPE = 'query';
    public const MESSAGE_NAME = 'name';
    public const MESSAGE_VERSION = 'version';

    public const PAYLOAD = 'payload';
    public const METADATA = 'metadata';

    protected array $payload;
    protected array $metadata;

    public function __construct(array $payload, array $metadata = [])
    {
        $this->payload = $payload;

        $defaultMetadata = [
            self::MESSAGE_NAME => 'message',
            self::MESSAGE_VERSION => '1',
        ];
        $this->metadata = array_merge($defaultMetadata, $metadata);
    }

    protected static function messageType(): string
    {
        return self::MESSAGE_TYPE;
    }

    protected function get(string $key)
    {
        if (!array_key_exists($key, $this->payload)) {
            throw new InvalidArgumentException(
                sprintf('The element with key <%s> does not exist in the payload', $key)
            );
        }

        return $this->payload[$key];
    }
}
