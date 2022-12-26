<?php

namespace Mage\Todo\Api;

use Mage\Todo\Api\Data\TaskInterface;

interface CustomerTaskListInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getList(): array;
}
