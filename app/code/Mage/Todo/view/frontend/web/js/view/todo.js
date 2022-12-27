define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'Mage_Todo/js/service/task'
], function (Component, $, modal, taskService) {
    'use strict';

    return Component.extend({
        defaults: {
            buttonSelector: '#add-new-task-button',
            newTaskLabel: '',
            tasks: []
        },
        initObservable: function () {
            this._super().observe(['tasks', 'newTaskLabel']);

            let self = this;
            taskService.getList().then(function (tasks) {
                self.tasks(tasks);
                return this;
            });

            return this;
        },

        switchStatus: function (data, event) {
            const taskId = $(event.target).data('id');

            let items = this.tasks.map(function (task) {
                if (task.task_id === taskId) {
                    task.status = task.status === 'open' ? 'complete' : 'open';
                    taskService.update(taskId, task.status);
                }
                return task;
            });
            this.tasks(items);
        },

        deleteTask: function (taskId) {
            let self = this;

            modal({
                content: 'Are you sure you want to delete the task?',
                actions: {
                    confirm: function () {
                        let tasks = [];
                        taskService.delete(self.tasks().find(function (task) {
                            if (task.task_id === taskId) {
                                return task;
                            }
                        }));
                        if (self.tasks().length === 1) {
                            self.tasks(tasks);
                            return;
                        }

                        self.tasks().forEach(function (task) {
                            if (task.task_id !== taskId) {
                                tasks.push(task);
                            }
                        });

                        self.tasks(tasks);
                    }
                }
            });
        },
        addTask: function () {
            const self = this;

            let task = {
                label: this.newTaskLabel(),
                status: 'open'
            };

            taskService.create(task)
                .then(function (taskId) {
                    task.task_id = taskId
                    self.tasks.push(task)
                    self.newTaskLabel('')
                })
        },
        checkKey: function (data, event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(this.buttonSelector).click();
            }
        }
    });
});
