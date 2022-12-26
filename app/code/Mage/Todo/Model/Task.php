<?php

namespace Mage\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;
use Mage\Todo\Api\TaskManagementInterface;
class Task extends AbstractModel implements  TaskManagementInterface
{
    protected function _construct()
    {
        $this->_init(TaskResource::class);
    }
}
