<?php

namespace Magnetis\Medias;

class Category
{
    public string $name;

    public int $maxMedia = 0;

    public bool $default = false;

    public function __construct(string $name, int $maxMedia = 0, bool $default = false)
    {
        $this->name = $name;
        $this->maxMedia = $maxMedia;
        $this->default = $default;
    }

    public function addMedia(Media $media)
    {
        if ($this->maxMedia && count($this->medias) > $this->maxMedia) {
            throw new \RuntimeException("Media limit exceed in categorie '{$this->name}'.");
        }

        $this->medias[] = $media;
    }
}
