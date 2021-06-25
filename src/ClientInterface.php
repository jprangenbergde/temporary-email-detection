<?php

declare(strict_types=1);

namespace TemporaryEmailDetection;

/**
 * @author Marcel Strahl <info@marcel-strahl.de>
 */
interface ClientInterface
{
    /**
     * @psalm-param non-empty-string $value
     */
    public function isTemporary(string $value): bool;
}
