<?php

namespace Mage\Todo\Test\Unit\Service;


use Mage\Todo\Service\CustomerTaskList;
use Mage\Todo\Service\TaskRepository;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Mage\Todo\Model\ResourceModel\Task;
use Mage\Todo\Model\TaskFactory;
use Mage\Todo\Api\Data\TaskSearchResultInterface;
use Mage\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteria;
use Mage\Todo\Api\Data\TaskInterface;

class TaskRepositoryTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $resource;

    /**
     * @var MockObject
     */
    private $taskFactory;

    /**
     * @var MockObject
     */
    private $searchResultsFactory;

    /**
     * @var MockObject
     */
    private $collectionProcessor;

    /**
     * @var MockObject
     */
    private $searchCriteria;

    /**
     * @var MockObject
     */
    private $taskInterface;

    /**
     * @var MockObject
     */
    private $taskRepository;


    protected function setUp():void
    {
        $this->resource = $this->getMockBuilder(\Mage\Todo\Model\ResourceModel\Task::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->taskFactory = $this->getMockBuilder(\Mage\Todo\Model\TaskFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchResultsFactory = $this->getMockForAbstractClass(
            \Mage\Todo\Api\Data\TaskSearchResultInterfaceFactory::class,
            [],
            '',
            false,
            false,
            true,
            ['create','setSearchCriteria']
        );

        $this->collectionProcessor = $this->getMockForAbstractClass(
            \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['process']
        );

        $this->searchCriteriaBuilder = $this->getMockBuilder(SearchCriteriaBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCriteria = $this->getMockBuilder(\Magento\Framework\Api\SearchCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->taskInterface = $this->getMockForAbstractClass(
            \Mage\Todo\Api\Data\TaskInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['create']
        );
        $this->taskRepository = $this->getMockBuilder(TaskRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetList()
    {
        $expectedTaskLabel = 'Mage Mastery';
        $expectedTaskLabel2 = 'My Unit Test';
        $task1 = $this->getMockForAbstractClass(
            TaskInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getLabel']
        );
        $task1->expects($this->any())
            ->method('getLabel')
            ->willReturn($expectedTaskLabel);
        $task2 = $this->getMockForAbstractClass(
            TaskInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getLabel']
        );
        $task2->expects($this->any())
            ->method('getLabel')
            ->willReturn($expectedTaskLabel2);
        $this->taskRepository->expects($this->any())
            ->method('getList')
            ->with($this->searchCriteria)
            ->willReturn($this->searchResultsFactory);

        $this->searchResultsFactory->expects($this->any())
            ->method('create')
            ->willReturn($this->searchResultsFactory);
        $this->searchResultsFactory->expects($this->any())
            ->method('setSearchCriteria')
            ->with($this->searchCriteria)
            ->willReturn($this->searchResultsFactory);
        $this->collectionProcessor->expects($this->any())
            ->method('process')
            ->with($this->searchCriteria, $this->searchResultsFactory)
            ->willReturn($this->searchResultsFactory);
        $this->searchCriteriaBuilder->expects($this->any())
            ->method('create')
            ->willReturn($this->searchCriteria);

        $object = new TaskRepository(
            $this->resource,
            $this->taskFactory,
            $this->collectionProcessor,
            $this->searchResultsFactory
        );

        $tasks = $object->getList($this->searchCriteria);
        $this->assertNotEmpty($tasks);
        $this->assertEquals($tasks[0]->getLabel(), $expectedTaskLabel);
        $this->assertEquals($tasks[1]->getLabel(), $expectedTaskLabel2);
    }

    public function testGet($taskId)
    {
        $this->resource->expects($this->any())
            ->method('load')
            ->with($this->taskFactory, $taskId)
            ->willReturn($this->taskInterface);

        $object = new TaskRepository(
            $this->resource,
            $this->taskFactory,
            $this->collectionProcessor,
            $this->searchResultsFactory
        );

        $tasks = $object->get(1);

        $this->assertNotEmpty($tasks);
    }
}
