<?php

namespace TemporaryEmailDetection;

use Exception as StandardException;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class Exception extends StandardException
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