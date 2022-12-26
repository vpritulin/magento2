<?php

namespace Mage\Todo\Service;

use Mage\Todo\Api\CustomerTaskListInterface;
use Mage\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Mage\Todo\Api\Data\TaskInterface;

class CustomerTaskList implements CustomerTaskListInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private TaskRepositoryInterface $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder   $searchCriteriaBuilder
    )
    {
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return array|TaskInterface[]|\Magento\Framework\Api\Search\DocumentInterface[]
     */
    public function getList()
    {
        return $this->taskRepository
            ->getList($this->searchCriteriaBuilder->create())
            ->getItems();
    }
}
