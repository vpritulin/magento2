<?php

namespace Mage\Todo\Model\ResourceModel\Task;

use Mage\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;
use Mage\Todo\Model\Task;

class Collection extends AbstractCollection implements TaskSearchResultInterface
{
    /**
     * @var SearchCriteriaInterface
     */
    private SearchCriteriaInterface $searchCriteria;

    /**
     * @var \Magento\Framework\Api\Search\AggregationInterface
     */
    private \Magento\Framework\Api\Search\AggregationInterface $aggregations;

    /**
     * @return void
     */

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Task::class, TaskResource::class);
    }

    /**
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria(): SearchCriteriaInterface
    {
        return $this->searchCriteria;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->getSize();
    }

    /**
     * @param $totalCount
     * @return $this|Collection
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @param array $items
     * @return TaskSearchResultInterface
     * @throws \Exception
     */
    public function setItems(array $items): TaskSearchResultInterface
    {
        if (!$items) {
            return $this;
        }
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @return \Magento\Framework\Api\Search\AggregationInterface
     */
    public function getAggregations(): \Magento\Framework\Api\Search\AggregationInterface
    {
        return $this->aggregations;
    }

    /**
     * @param $aggregations
     * @return void
     */
    public function setAggregations($aggregations): void
    {
        $this->aggregations = $aggregations;
    }
}
