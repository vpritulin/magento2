<?php

namespace Mage\Todo\Api;

/**
 * @api
 */
interface TaskStatusManagementInterface
{
    /**
     * @param int $task_id
     * @param string $status
     * @return bool
     */
    public function change(int $task_id,string $status): bool;
}
