<?php

namespace Mage\Todo\Test\Unit\Service;

use Mage\Todo\Api\Data\TaskInterface;
use Mage\Todo\Service\CustomerTaskList;
use Mage\Todo\Service\TaskRepository;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Api\SearchCriteria;
use Mage\Todo\Api\Data\TaskSearchResultInterface;

class CustomerTaskListTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $taskRepository;

    /**
     * @var MockObject
     */
    private $searchCriteriaBuilder;

    /**
     * @var MockObject
     */
    private $searchCriteria;

    /**
     * @var MockObject
     */
    private $taskSearchResult;

    protected function setUp():void
    {
        $this->taskRepository = $this->getMockForAbstractClass(TaskRepository::class,
            [],
            '',
            false,
            false,
            true,
            ['getList']);
        $this->searchCriteriaBuilder = $this->getMockBuilder(SearchCriteriaBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->searchCriteria = $this->getMockBuilder(SearchCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->taskSearchResult = $this->getMockForAbstractClass(
            TaskSearchResultInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['getItems']
        );
    }
    public function testGetList()
    {
        $expectedTaskLabel = 'Mage';
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
            ->willReturn($this->taskSearchResult);

        $this->taskSearchResult->expects($this->any())
            ->method('getItems')
            ->willReturn([$task1, $task2]);

        $this->searchCriteriaBuilder->expects($this->any())
            ->method('create')
            ->willReturn($this->searchCriteria);

        $object = new CustomerTaskList(
            $this->taskRepository,
            $this->searchCriteriaBuilder
        );

        $tasks = $object->getList();

        $this->assertNotEmpty($tasks);
        $this->assertEquals($tasks[0]->getLabel(), $expectedTaskLabel);
        $this->assertEquals($tasks[1]->getLabel(), $expectedTaskLabel2);
    }
}
