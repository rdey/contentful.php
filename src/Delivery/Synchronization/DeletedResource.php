<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Delivery\Synchronization;

use Contentful\Delivery\SystemProperties;

/**
 * A DeletedResource encodes metadata about a deleted resource.
 */
abstract class DeletedResource implements \JsonSerializable
{
    /**
     * @var SystemProperties
     */
    protected $sys;

    /**
     * DeletedResource constructor.
     *
     * @param SystemProperties $sys
     */
    public function __construct(SystemProperties $sys)
    {
        $this->sys = $sys;
    }

    /**
     * Returns the ID of the resource.
     *
     * @return string
     */
    public function getId()
    {
        return $this->sys->getId();
    }

    /**
     * Returns the space the resource used to belong to.
     *
     * @return \Contentful\Delivery\Space
     */
    public function getSpace()
    {
        return $this->sys->getSpace();
    }

    /**
     * Returns the last revision of the resource before it was deleted.
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->sys->getRevision();
    }

    /**
     * Returns the time when the resource was updated.
     *
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt()
    {
        return $this->sys->getUpdatedAt();
    }

    /**
     * Returns the time when the resource was created.
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return $this->sys->getCreatedAt();
    }

    /**
     * Returns the time when the resource was deleted.
     *
     * @return \DateTimeImmutable
     */
    public function getDeletedAt()
    {
        return $this->sys->getDeletedAt();
    }

    /**
     * Returns an object to be used by `json_encode` to serialize objects of this class.
     *
     * @return object
     *
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php JsonSerializable::jsonSerialize
     */
    public function jsonSerialize()
    {
        return (object) [
            'sys' => $this->sys,
        ];
    }
}
