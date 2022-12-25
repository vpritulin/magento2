<?php

namespace Mage\Todo\Api;

/**
 * @api
 */
interface TaskManagementInterface
{
    public function save();
    public function delete();
}
