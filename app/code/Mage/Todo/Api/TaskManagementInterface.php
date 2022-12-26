<?php

namespace Mage\Todo\Api;

use Mage\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface TaskManagementInterface
{
    public function save(TaskInterface $task);
    public function delete(TaskInterface $task);
}
