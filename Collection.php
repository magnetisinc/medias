<?php

namespace App\Models\Medias;

use App\BasicTypes\StringList;

class Collection implements \IteratorAggregate, \Countable
{
    public string $version = '';
    public string $sourceHash = '';

    /**
     * @var Media[]
     */
    protected array $medias = [];

    public function addMedia(Media $media)
    {
        $this->medias[] = $media;
    }

    public function addMedias(array $medias)
    {
      foreach ($medias as $media) {
        $this->addMedia($media);
      }
    }

    /**
     * @return Media[]
     */
    public function &getIterator()
    {
      foreach ($this->medias as &$media) {
        yield $media;
      }
    }

    public function clear()
    {
        $this->medias = [];
        return $this;
    }

    public function findCategory(string $categoryName): array
    {
        $medias = [];
        foreach ($this->medias as $media) {
            if ($media->category === $categoryName) {
              $medias[] = $media;
            }
        }

        return $medias;
    }

    static function recursive(array $elements, callable $callback) {
      $result = [];
      foreach ($elements as $element) {
        $r = $callback($element);
        if ($r) {
          $result[] = $r;
        }
      }

      return $result;
    }

    public function first(): ?Media
    {
      return $this->medias[0] ?? null;
    }

    public function asList(int $offset = 0): StringList
    {
      $urls = self::recursive($this->medias, static function($element) {
        return $element instanceof Media ? $element->url : false;
      });

      return StringList::cast(array_slice($urls, $offset));
    }

    public function isEmpty()
    {
      return $this->medias === [];
    }

    public function isNotEmpty()
    {
      return $this->medias !== [];
    }

  public function count()
  {
    return count($this->medias);
  }
}
