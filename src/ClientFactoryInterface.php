<?php

declare(strict_types=1);

namespace TemporaryEmailDetection;

/**
 * @author Marcel Strahl <info@marcel-strahl.de>
 */
interface ClientFactoryInterface
{
    public function factorize(): ClientInterface;
}
