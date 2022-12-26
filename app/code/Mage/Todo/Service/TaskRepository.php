<?php

namespace Mage\Todo\Service;

use Mage\Todo\Api\Data\TaskSearchResultInterface;
use Mage\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use \Mage\Todo\Api\TaskRepositoryInterface;
use \Mage\Todo\Model\ResourceModel\Task;
use \Mage\Todo\Model\TaskFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private Task $resource;

    /**
     * @var TaskFactory
     */
    private TaskFactory $taskFactory;

    /**
     * @var TaskSearchResultInterfaceFactory
     */
    private TaskSearchResultInterfaceFactory $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;
    public function __construct(
        Task                             $resource,
        TaskFactory                      $taskFactory,
        CollectionProcessorInterface     $collectionProcessor,
        TaskSearchResultInterfaceFactory $searchResultFactory
    )
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface
    {
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $searchResult);
        return $searchResult;
    }

    public function get(int $tasksId): \Mage\Todo\Model\Task
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $tasksId);
        return $object;
    }
}
