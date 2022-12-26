<?php

namespace Mage\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;
use Mage\Todo\Api\Data\TaskInterface;

class Task extends AbstractModel implements TaskInterface
{
    const TASK_ID = 'task_id';
    const STATUS = 'status';
    const LABEL = 'label';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(TaskResource::class);
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return (int)$this->getData(self::TASK_ID);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getData(self::LABEL);
    }
}
