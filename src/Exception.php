<?php

declare(strict_types=1);

namespace TemporaryEmailDetection;

use Exception as StandardException;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
final class Exception extends StandardException
{
    /**
     * @param string $message
     *
     * @return self
     */
    public static function fromMessage(string $message): self
    {
        return new self($message);
    }
}
