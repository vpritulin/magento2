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
use Magento\Framework\Api\SearchCriteriaBuilder;
use Mage\Todo\Api\TaskManagementInterface;
class Index extends Action
{

    /**
     * @var TaskResource
     */
    private TaskResource $taskResource;

    /**
     * @var TaskFactory
     */
    private TaskFactory $taskFactory;

    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    private TaskManagementInterface $taskManagement;

    /**
     * @param Context $context
     * @param TaskFactory $taskFactory
     * @param TaskResource $taskResource
     * @param TaskRepository $taskRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TaskManagementInterface $taskManagement
     */
    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        TaskResource $taskResource,
        TaskRepository $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaskManagementInterface $taskManagement
    )
    {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->taskManagement = $taskManagement;
        parent::__construct($context);
    }


    public function execute()
    {
        $task = $this->taskRepository->get(1);
        $task->setData('status','complete');
        $this->taskManagement->save($task);

       $task = $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();
       var_dump($this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems());
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
