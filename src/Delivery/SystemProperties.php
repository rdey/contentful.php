<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Delivery;

/**
 * A SystemProperties instance contains the metadata of a resource.
 */
class SystemProperties implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Space|null
     */
    private $space;

    /**
     * @var ContentType|null
     */
    private $contentType;

    /**
     * @var int|null
     */
    private $revision;

    /**
     * @var string|null
     */
    private $locale;

    /**
     * @var \DateTimeImmutable|null
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable|null
     */
    private $updatedAt;

    /**
     * @var \DateTimeImmutable|null
     */
    private $deletedAt;

    /**
     * SystemProperties constructor.
     *
     * @param string                  $id
     * @param string                  $type
     * @param Space|null              $space
     * @param ContentType|null        $contentType
     * @param int|null                $revision
     * @param \DateTimeImmutable|null $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $deletedAt
     * @param string|null             $locale
     */
    public function __construct($id, $type, Space $space = null, ContentType $contentType = null, $revision = null,
                                \DateTimeImmutable $createdAt = null, \DateTimeImmutable $updatedAt = null,
                                \DateTimeImmutable $deletedAt = null, $locale = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->space = $space;
        $this->contentType = $contentType;
        $this->revision = $revision;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Space|null
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * @return ContentType|null
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return int|null
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @return string|null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
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
        $obj = new \stdClass();

        if (null !== $this->id) {
            $obj->id = $this->id;
        }
        if (null !== $this->type) {
            $obj->type = $this->type;
        }
        if (null !== $this->space) {
            $obj->space = (object) [
                'sys' => (object) [
                    'type' => 'Link',
                    'linkType' => 'Space',
                    'id' => $this->space->getId(),
                ],
            ];
        }
        if (null !== $this->contentType) {
            $obj->contentType = (object) [
                'sys' => (object) [
                    'type' => 'Link',
                    'linkType' => 'ContentType',
                    'id' => $this->contentType->getId(),
                ],
            ];
        }
        if (null !== $this->revision) {
            $obj->revision = $this->revision;
        }
        if (null !== $this->locale) {
            $obj->locale = $this->locale;
        }
        if (null !== $this->createdAt) {
            $obj->createdAt = \Contentful\format_date_for_json($this->createdAt);
        }
        if (null !== $this->updatedAt) {
            $obj->updatedAt = \Contentful\format_date_for_json($this->updatedAt);
        }
        if (null !== $this->deletedAt) {
            $obj->deletedAt = \Contentful\format_date_for_json($this->deletedAt);
        }

        return $obj;
    }
}
