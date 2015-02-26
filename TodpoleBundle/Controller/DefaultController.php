<?php

namespace Todpole\TodpoleBundle\Controller;

use Topxia\AdminBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        $todpoleSetting = $this->getSettingService()->get('todpole', array());
        if (empty($todpoleSetting)) {
            $default = array(
                'enabled' => 0,
            );
            $todpoleSetting = $default;
        }

        if ($request->getMethod() == 'POST') {
            $fields = $request->request->all();
            if ($todpoleSetting['enabled'] != $fields['enabled']) {
                $start = __DIR__ . "/../workerman-todpole/start.php";
                if ($todpoleSetting['enabled']) {
                    exec("php " . $start .  " start -d");
                } else {
                    exec("php " . $start .  " stop");
                }
            }
            $this->getSettingService()->set('todpole', $fields);
            $this->setFlashMessage('success', '设置已保存！');
        }

        return $this->render('TodpoleBundle:Default:index.html.twig', array());
    }

    protected function getSettingService()
    {
        return $this->getServiceKernel()->createService('System.SettingService');
    }
}
