<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\Persistance\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramsey\Uuid\Doctrine\UuidBinaryType;
use Ramsey\Uuid\Uuid;

class DoctrineUuidType extends UuidBinaryType
{
    private const TYPE_NAME = 'shared_uuid';

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Uuid|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return null;
        }

        $uuid = \Ramsey\Uuid\Uuid::fromBytes($value);

        $specificUuidType = $this->specificUuidType();

        return $specificUuidType::fromString($uuid->toString());
    }

    /**
     * @param Uuid|null $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return !is_null($value) ? sodium_hex2bin(str_replace('-', '', $value->value())): null;
    }

    /**
     * @return string
     */
    protected function specificUuidType(): string
    {
        return Uuid::class;
    }

    public function getName()
    {
        return self::TYPE_NAME;
    }
}
