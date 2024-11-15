<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;

class SeoService
{
    /**
     * Configure SEO for a given page.
     *
     * @param string $title
     * @param string $description
     * @param string $canonical
     * @param array $keywords
     * @param string|null $image
     */
    public function setPageSeo(string $title, string $description, string $canonical, array $keywords = [], ?string $image = null): void
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical($canonical);
        SEOTools::metatags()->setKeywords($keywords);

        $image = $image ?? asset('images/default-image.jpg'); // Image par défaut

        // OpenGraph configuration
        $this->setOpenGraph($title, $description, $canonical, $image);

        // Twitter Cards configuration
        $this->setTwitter($title, $description, $canonical, $image);

        // JSON-LD (Structured Data) configuration
        $this->setJsonLd($title, $description, $canonical, $image);
    }

    /**
     * Configure OpenGraph metadata.
     *
     * @param string $title
     * @param string $description
     * @param string $canonical
     * @param string $image
     */
    protected function setOpenGraph(string $title, string $description, string $canonical, string $image): void
    {
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription($description);
        SEOTools::opengraph()->setUrl($canonical);
        SEOTools::opengraph()->addImage($image);
        SEOTools::opengraph()->setType('website');
    }

    /**
     * Configure Twitter metadata.
     *
     * @param string $title
     * @param string $description
     * @param string $canonical
     * @param string $image
     */
    protected function setTwitter(string $title, string $description, string $canonical, string $image): void
    {
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setUrl($canonical);
        SEOTools::twitter()->setImage($image);
    }

    /**
     * Configure JSON-LD metadata.
     *
     * @param string $title
     * @param string $description
     * @param string $canonical
     * @param string $image
     */
    protected function setJsonLd(string $title, string $description, string $canonical, string $image): void
    {
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->setUrl($canonical);
        SEOTools::jsonLd()->addImage($image);
    }
}