<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Exception;

/**
 * A SpaceMismatchException is thrown when attempting to create a Resource for a different Space than the one configured for the client.
 */
class SpaceMismatchException extends \RuntimeException
{
}
