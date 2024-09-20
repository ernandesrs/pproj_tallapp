<?php

namespace App\Builders\Page;

class Page
{
    /**
     * Constructor
     * @param string $title
     * @param \App\Builders\Page\Breadcrumb $breadcrumb
     */
    function __construct(
        public string $title,
        public Breadcrumb $breadcrumb,
        public ?string $subtitle = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public ?string $cover = null,
        public ?bool $index = false,
    ) {
    }

    /**
     * Get title
     * @return string
     */
    function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get subtitle
     * @return ?string
     */
    function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * Get title from breadcrumb
     * @return string
     */
    function getTitleFromBreadcrumb(): string
    {
        return $this->getBreadcrumb()->getAsTitle();
    }

    /**
     * Get breadcrumb
     * @return \App\Builders\Page\Breadcrumb
     */
    function getBreadcrumb(): Breadcrumb
    {
        return $this->breadcrumb;
    }

    /**
     * Get description
     * @return ?string
     */
    function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get keywords
     * @return ?string
     */
    function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * Get cover
     * @return ?string
     */
    function getCover(): ?string
    {
        return $this->cover;
    }

    /**
     * Get index
     * @return ?string
     */
    function getIndex(): string
    {
        return $this->index ? 'index,follow' : 'noindex,nofollow';
    }
}
