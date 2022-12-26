<?php

namespace Mage\Todo\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface TaskSearchResultInterface extends SearchResultsInterface
{
    public function getItems();

    public function setItems(array $items);
}
