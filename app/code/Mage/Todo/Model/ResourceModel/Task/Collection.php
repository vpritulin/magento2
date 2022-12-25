<?php

namespace Mage\Todo\Model\ResourceModel\Task;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;
use Mage\Todo\Model\Task;

class Collection extends AbstractCollection
{
    protected function __construct()
    {
        $this->_init(Task::class, TaskResource::class);
    }
}
