<?php

namespace Mage\Todo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Mage\Todo\Model\Task;
use Mage\Todo\Model\ResourceModel\Task as TaskResource;
use Mage\Todo\Model\TaskFactory;
use Mage\Todo\Service\TaskRepository;
class Index extends Action
{

    private $taskResource;
    private $taskFactory;

    private $taskRepository;

    public function __construct(Context $context, TaskFactory $taskFactory, TaskResource $taskResource, TaskRepository $taskRepository)
    {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
       $task = $this->taskRepository->get(1);
       var_dump($task->getData());
//        $task = $this->taskFactory->create();
//        $task->setData([
//            'label'=>'New Task 22',
//            'status'=>'open',
//            'customer_id'=>1
//        ]);
//        $this->taskResource->save($task);
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
