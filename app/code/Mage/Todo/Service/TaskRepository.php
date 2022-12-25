<?php

namespace Mage\Todo\Service;

use \Mage\Todo\Api\TaskRepositoryInterface;
use \Mage\Todo\Model\ResourceModel\Task;
use \Mage\Todo\Model\TaskFactory;
class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var
     */
    private $resource;

    /**
     * @var
     */
    private $taskFactory;
    public function __construct(Task $resource, TaskFactory $taskFactory)
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
    }

    public function getList()
    {
        // TODO: Implement getList() method.
    }

    public function get(int $tasksId): \Mage\Todo\Model\Task
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $tasksId);
        return $object;
    }
}
