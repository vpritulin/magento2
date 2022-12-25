<?php

namespace Mage\Todo\Api;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function getList();
    public function  get(int $tasksId);
}
