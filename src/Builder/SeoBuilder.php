<?php

namespace FriendsOfInertia\LaravelSeo\Builder;

class SeoBuilder extends AbstractBuilder
{
    private MetaTagBuilder $metaTagBuilder;

    /**
     * In the construct of our SEO builder, we will accept the other builders it
     * is to manage. When a helper method on this class is called, the relevent
     * builders will be updates.
     *
     * @param  MetaTagBuilder  $metaTagBuilder
     */
    public function __construct(MetaTagBuilder $metaTagBuilder)
    {
        parent::__construct();

        $metaTagBuilder->setTags($this->getTags());

        $this->metaTagBuilder = $metaTagBuilder;
    }

    /**
     * Sets the SEO title.
     *
     * @return self
     */
    public function title(string $title): self
    {
        $this->metaTagBuilder->title($title);

        return $this;
    }

    /**
     * Sets the SEO description.
     *
     * @return self
     */
    public function description(string $description): self
    {
        $this->metaTagBuilder->description($description);

        return $this;
    }

    /**
     * Exposes the meta builder to the passed callback for more advanced settings.
     *
     * @param  callable  $callback
     * @return self
     */
    public function meta(callable $callback): self
    {
        $callback($this->metaTagBuilder);

        return $this;
    }
}
