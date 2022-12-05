<?php

namespace Magnetis\Medias;

use Exception;
use JetBrains\PhpStorm\Internal\TentativeType;
use Traversable;

class CategoryCollection implements \IteratorAggregate, \Countable
{
  /**
   * @var Category[]
   */
  protected array $categories = [];

  public function add(Category $category)
  {
    if ($category->default) {
      foreach ($this->categories as $cat) {
        if ($cat->default) {
          throw new \RuntimeException("Collection already contain '{$cat->name}' as default category.");
        }
      }
    }

    $this->categories[] = $category;
  }

  public function default(): Category
  {
    foreach ($this->categories as $cat) {
      if ($cat->default) {
        return $cat;
      }
    }

    return $this->categories[0];
  }

  public function getIterator()
  {
    foreach ($this->categories as $category) {
      yield $category;
    }
  }

  public function isEmpty(): bool
  {
    return $this->categories === [];
  }

  public function count(): int
  {
    return count($this->categories);
  }
}