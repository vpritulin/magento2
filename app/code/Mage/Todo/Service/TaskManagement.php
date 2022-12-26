<?php

namespace Mage\Todo\Service;

use Mage\Todo\Api\Data\TaskInterface;
use Mage\Todo\Api\TaskManagementInterface;
use Mage\Todo\Model\ResourceModel\Task;

class TaskManagement implements  TaskManagementInterface
{

    /**
     * @var Task
     */
    private Task $resource;
    public function __construct(Task $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param TaskInterface $task
     * @return int
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(TaskInterface $task): int
    {
        $this->resource->save($task);
        return $task->getTaskId();
    }

    /**
     * @param TaskInterface $task
     * @return bool
     * @throws \Exception
     */
    public function delete(TaskInterface $task): bool
    {
        $this->resource->delete($task);
        return true;
    }
}
