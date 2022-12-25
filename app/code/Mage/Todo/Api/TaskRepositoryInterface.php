<?php

namespace Mage\Todo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use \Mage\Todo\Api\Data\TaskSearchResultInterface;
/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface;
    public function  get(int $tasksId);
}
