<?php

namespace Mage\Todo\Api;

use Mage\Todo\Api\Data\TaskInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use \Mage\Todo\Api\Data\TaskSearchResultInterface;
/**
 * @api
 */
interface TaskRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface;

    /**
     * @param int $tasksId
     * @return TaskInterface
     */
    public function  get(int $tasksId): TaskInterface;
}
