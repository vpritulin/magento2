<?php

namespace Mage\Todo\Service;

use Mage\Todo\Api\TaskStatusManagementInterface;
use Mage\Todo\Api\TaskRepositoryInterface;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private TaskRepositoryInterface $repository;

    /**
     * @var TaskStatusManagementInterface
     */
    private TaskStatusManagementInterface $management;

    /**
     * @param TaskRepositoryInterface $repository
     * @param TaskStatusManagementInterface $management
     */
    public function __construct(TaskRepositoryInterface $repository, TaskStatusManagementInterface $management)
    {
        $this->repository = $repository;
        $this->management = $management;
    }

    /**
     * @param int $task_id
     * @param string $status
     * @return bool
     */
    public function change(int $task_id, string $status): bool
    {
        if (!in_array($status, ['open', 'complete'])) {
            return false;
        }
        $task = $this->repository->get($task_id);
        $task->setData('status', $status);
        $this->management->save($task);
        return true;
    }
}
