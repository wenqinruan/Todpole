<?php
namespace Todpole\Service\Todpole\Impl;

use Topxia\Service\Common\BaseService;
use Todpole\Service\Todpole\TodpoleService;

class TodpoleServiceImpl extends BaseService implements TodpoleService
{
    protected function getTodpoleDao()
    {
        return $this->createDao('Todpole:Todpole.TodpoleDao');
    }
}