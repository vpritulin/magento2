<?php

namespace Mage\Todo\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Task extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mage_todo_task', 'task_id');
    }
}
