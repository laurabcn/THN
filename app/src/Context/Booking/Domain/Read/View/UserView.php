<?php

declare(strict_types=1);

namespace App\Context\Booking\Domain\Read\View;

final class UserView
{
    private function __construct(
        private array $users
    )
    {
    }

    public static function build(
        array $users
    ): UserView {
        return new self($users);
    }

    public function users(): array
    {
        return $this->users;
    }
}