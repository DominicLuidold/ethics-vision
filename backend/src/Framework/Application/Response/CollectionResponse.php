<?php

declare(strict_types=1);

namespace Framework\Application\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @template T
 */
abstract readonly class CollectionResponse
{
    public int $pages;

    /**
     * @param array<T> $items
     */
    public function __construct(
        private array $items,
        public int $total,
        public int $page,
        public int $limit,
    ) {
        $this->pages = $this->calculatePages($total, $limit);
    }

    /**
     * @return array<T>
     */
    #[SerializedName('_embedded')]
    public function getItems(): array
    {
        return $this->items;
    }

    private function calculatePages(int $itemCount, int $limit): int
    {
        $calculatedPages = (int) ceil($itemCount / $limit);

        return $calculatedPages > 0 ? $calculatedPages : 1;
    }
}
