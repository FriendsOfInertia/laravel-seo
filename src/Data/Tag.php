<?php

namespace FriendsOfInertia\LaravelSeo\Data;

use FriendsOfInertia\LaravelSeo\Exception\InvalidTagType;

class Tag
{
    const TITLE = 'title';
    const META  = 'meta';

    private array $attributes = [];
    private ?string $content  = null;
    private string $type;
    private ?string $unique = null;

    /**
     * Require the setting of the type on construct.
     * 
     * @param  string  $type
     */
    public function __construct(string $type)
    {
        $this->setType($type);
    }

    /**
     * Fluent helper to create a new tag instance.
     *
     * @param  string  $type
     * @return self
     */
    public static function new(string $type): self
    {
        return new self($type);
    }

    /**
     * Returns the attributes this HTML tag has.
     *
     * @return null|array
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * Determines whether or not the tag has attributes.
     *
     * @return bool
     */
    public function hasAttributes(): bool
    {
        return ! empty($this->attributes);
    }

    /**
     * Sets the attributes this tag has.
     *
     * @param  array  $attributes
     * @return self
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Returns the content of the tag.
     *
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Determines whether or not the tag has content.
     *
     * @return bool
     */
    public function hasContent(): bool
    {
        return isset($this->content);
    }

    /**
     * Sets the content of the tag.
     *
     * @param  string  $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the type of tag we are dealing with.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the type of tag we are dealing with.
     *
     * @param  string  $type
     * @return self
     */
    public function setType(string $type): self
    {
        if (! in_array($type, [self::TITLE, self::META])) {
            throw new InvalidTagType(
                "Tag type must be 'title' or 'meta'. Received {$type}."
            );
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Returns the key by which the unique tag should be identified.
     *
     * @return null|string
     */
    public function getUnique(): ?string
    {
        return $this->unique;
    }

    /**
     * Returns whether or not the tag is expected to be unique.
     *
     * @return bool
     */
    public function isUnique(): bool
    {
        return isset($this->unique);
    }

    /**
     * Sets a value that the tag should be identified by to ensure it is unique.
     *
     * @param  string  $unique
     * @return self
     */
    public function setUnique(string $unique): self
    {
        $this->unique = $unique;

        return $this;
    }
}
