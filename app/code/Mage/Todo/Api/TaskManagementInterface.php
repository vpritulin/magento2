<?php

namespace Mage\Todo\Api;

use Mage\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface TaskManagementInterface
{
    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function save(TaskInterface $task):bool;

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function delete(TaskInterface $task):bool;
}
