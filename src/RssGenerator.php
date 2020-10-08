<?php

namespace Comoco\PodcastRssXml;

use Comoco\PodcastRssXml\Models\Item;
use Sabre\Xml\Service as XmlService;

class RssGenerator
{
    protected $title = '';

    protected $author = '';

    protected $owner = null;

    protected $description = '';

    protected $category = null;

    protected $imageUrl = null;

    protected $language = null;

    protected $link = '';

    protected $items = [];

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param \Comoco\PodcastRssXml\Models\Item $item
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return string rss xml content
     */
    public function toXML()
    {
        $attributes = [
            'version' => '2.0',
            'xmlns:googleplay' => 'http://www.google.com/schemas/play-podcasts/1.0',
            'xmlns:itunes' => 'http://www.itunes.com/dtds/podcast-1.0.dtd',
        ];

        return (new XmlService)->write('rss', function ($writer) use ($attributes) {
            foreach ($attributes as $name => $text) {
                $writer->writeAttribute($name, $text);
            }

            $writer->write([
                'channel' => [
                    'title' => $this->title,
                    $this->getAuthorXml(),
                    $this->getOwnerXml(),
                    $this->getDescriptionXml(),
                    $this->getCategoryXml(),
                    $this->getImageXml(),
                    $this->getLanguageXml(),
                    'link' => $this->link,
                    $this->getItemsXml(),
                ],
            ]);
        });
    }

    protected function getAuthorXml()
    {
        return [
            'googleplay:author' => $this->author,
            'itunes:author' => $this->author,
        ];
    }

    protected function getOwnerXml()
    {
        if ($this->owner === null) {
            return null;
        }

        return [
            'googleplay:owner' => $this->owner,
            'itunes:owner' => $this->owner,
        ];
    }

    protected function getDescriptionXml()
    {
        return [
            'description' => $this->description,
            'googleplay:description' => $this->description,
            'itunes:summary' => $this->description,
        ];
    }

    protected function getCategoryXml()
    {
        if ($this->category === null) {
            return null;
        }

        return [
            'googleplay:category' => $this->category,
            'itunes:category' => $this->category,
        ];
    }

    protected function getImageXml()
    {
        if ($this->imageUrl === null) {
            return null;
        }

        return [
            'image' => [
                'link' => $this->imageUrl,
            ],
            [
                'name' => 'googleplay:image',
                'attributes' => [
                    'href' => $this->imageUrl,
                ],
            ],
            [
                'name' => 'itunes:image',
                'attributes' => [
                    'href' => $this->imageUrl,
                ],
            ],
        ];
    }

    protected function getLanguageXml()
    {
        if ($this->language === null) {
            return null;
        }

        return [
            'language' => $this->language,
        ];
    }

    protected function getItemsXml()
    {
        $datas = [];
        foreach ($this->items as $item) {
            $datas[] = $item->toXmlData();
        }

        return $datas;
    }
}
