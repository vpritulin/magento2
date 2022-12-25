<?php

namespace Mage\Todo\Api\Data;

use Magento\Framework\Api\Search\SearchResultInterface;

/**
 * @api
 */
interface TaskSearchResultInterface extends SearchResultInterface
{
    public function getItems(): array;

    public function setItems(array $items): TaskSearchResultInterface;
}
