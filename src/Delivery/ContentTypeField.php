<?php

/**
 * This file is part of the contentful.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Delivery;

/**
 * A ContentTypeField describes one field of a ContentType. This includes essential information for the display of the field's value.
 */
class ContentTypeField implements \JsonSerializable
{
    /**
     * ID of the Field.
     *
     * @var string
     */
    private $id;

    /**
     * Name of the Field.
     *
     * @var string
     */
    private $name;

    /**
     * Type of the Field.
     *
     * Valid values are:
     * - Symbol
     * - Text
     * - Integer
     * - Number
     * - Date
     * - Boolean
     * - Link
     * - Array
     * - Object
     *
     * @var string
     */
    private $type;

    /**
     * Type of the linked resource.
     *
     * Valid values are:
     * - Asset
     * - Entry
     *
     * @var string|null
     */
    private $linkType;

    /**
     * (Array type only) Type for items.
     *
     * @var string|null
     */
    private $itemsType;

    /**
     * (Array of links only) Type of links.
     *
     * Valid values are:
     * - Asset
     * - Entry
     *
     * @var string|null
     */
    private $itemsLinkType;

    /**
     * Describes whether the Field is mandatory.
     *
     * @var bool
     */
    private $required;

    /**
     * Describes whether the Field is localized.
     *
     * @var bool
     */
    private $localized;

    /**
     * Describes whether the Field is disabled.
     *
     * @var bool
     */
    private $disabled;

    /**
     * ContentTypeField constructor.
     *
     * @param string      $id
     * @param string      $name
     * @param string      $type
     * @param string|null $linkType
     * @param string|null $itemsType
     * @param string|null $itemsLinkType
     * @param bool        $required
     * @param bool        $localized
     * @param bool        $disabled
     */
    public function __construct($id, $name, $type, $linkType = null, $itemsType = null, $itemsLinkType = null, $required = false, $localized = false, $disabled = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->linkType = $linkType;
        $this->itemsLinkType = $itemsLinkType;
        $this->itemsType = $itemsType;
        $this->required = $required;
        $this->localized = $localized;
        $this->disabled = $disabled;
    }

    /**
     * Returns the ID of the content type.
     *
     * This is the internal identifier of the content type and is unique in the space.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the name of the content type.
     *
     * This is a human friendly name shown to the user.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the type of the field.
     *
     * Possible values are:
     * - Symbol
     * - Text
     * - Integer
     * - Number
     * - Date
     * - Boolean
     * - Link
     * - Array
     * - Object
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * If the field is a link, this will return the type of the linked resource.
     *
     * Possible values are:
     * - Asset
     * - Entry
     *
     * @return string|null
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * Returns true if this field is required.
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * Returns true if the field contains locale dependent content.
     *
     * @return bool
     */
    public function isLocalized()
    {
        return $this->localized;
    }

    /**
     * True if the field is disabled.
     *
     * Disabled fields are part of the API responses but not accessible trough the PHP SDK.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * If the field is an array, this returns the type of its items.
     *
     * Possible values are:
     * - Symbol
     * - Text
     * - Integer
     * - Number
     * - Date
     * - Boolean
     * - Link
     * - Object
     *
     * @return string|null
     */
    public function getItemsType()
    {
        return $this->itemsType;
    }

    /**
     * If the field is an array, and it's items are links, this returns the type of the linked resources.
     *
     * Possible values are:
     * - Asset
     * - Entry
     *
     * @return string|null
     */
    public function getItemsLinkType()
    {
        return $this->itemsLinkType;
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
        $obj = (object) [
            'name' => $this->name,
            'id' => $this->id,
            'type' => $this->type,
            'required' => $this->required,
            'localized' => $this->localized,
        ];

        if (null !== $this->linkType) {
            $obj->linkType = $this->linkType;
        }
        if ('Array' === $this->type) {
            $obj->items = (object) [
                'type' => $this->itemsType,
            ];
            if ('Link' === $this->itemsType) {
                $obj->items->linkType = $this->itemsLinkType;
            }
        }
        if ($this->disabled) {
            $obj->disabled = true;
        }

        return $obj;
    }
}
