<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Delivery\Cache;

use Psr\Cache\CacheItemPoolInterface;

class CacheClearer
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * CacheClearer constructor.
     *
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function clear()
    {
        $this->cache->clear();
    }
}
