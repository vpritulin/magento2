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
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(TaskInterface $task)
    {
        $this->resource->save($task);
    }

    /**
     * @param TaskInterface $task
     * @return void
     * @throws \Exception
     */
    public function delete(TaskInterface $task)
    {
        $this->resource->delete($task);
    }
}
