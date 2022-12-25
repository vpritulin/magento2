<?php

namespace Mage\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;

class Task extends AbstractModel
{
    protected function __construct()
    {
        $this->_init(TaskResource::class);
    }
}
