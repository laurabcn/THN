<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\Bus\Query;

use App\Context\Shared\Application\Bus\Query\Query;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Context\Shared\Application\Bus\Query\Response;
use Assert\Assertion;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

final class MessengerQueryBus implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $messageBus
    )
    {
    }

    public function ask(Query $query): ?Response
    {
        try {
            $envelope = $this->messageBus->dispatch($this->buildEnvelope($query));

            /** @var HandledStamp|null $handledStamp */
            $handledStamp = $envelope->last(HandledStamp::class);

            if (!$handledStamp) {
                return null;
            }

            $response = $handledStamp->getResult();
            Assertion::isInstanceOf($response, Response::class);

            return $response;
        } catch (HandlerFailedException $exception) {
            throw current($exception->getNestedExceptions());
        }
    }

    private function buildEnvelope(Query $query): Envelope
    {
        $messageName = 'message name';
        $envelope = new Envelope($query);

        return $envelope->with(
            new AmqpStamp(
                $messageName,
                0
            )
        );
    }
}
