<?php

namespace App\Models\Medias;

class Media
{
  //public \DateTime $created;
  public string $source = '';
  public string $url;

  public string $category = '';

  public function __construct($url = null, string $source = null)
  {
    //$this->created = new \DateTime();
    $this->url = (string) $url;
    $this->source = (string) ($source ?? $url);
  }

  public function asMedia()
  {
    $media = new self();
    //$media->created = $this->created;
    $media->url = $this->url;
    $media->source = $this->source;
    $media->category = $this->category;
    return $media;
  }
}
