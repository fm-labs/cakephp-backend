<?php

namespace Backend\Action;

use Backend\Action\Interfaces\ActionInterface;
use Backend\Action\Interfaces\EntityActionInterface;
use Backend\Action\Interfaces\IndexActionInterface;
use Cake\Controller\Controller;
use Cake\Network\Response;

class DebugAction implements ActionInterface, IndexActionInterface
{

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'debug';
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return __('Debug');
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return ['data-icon' => 'wrench'];
    }

    /**
     * @todo non-interface entity action method
     */
    public function getScope()
    {
        return ['table', 'form'];
    }

    /**
     * @todo non-interface entity action method
     */
    public function hasScope()
    {
        return true;
    }

    /**
     * @todo non-interface entity action method
     */
    public function isUsable()
    {
        return true;
    }

    /**
     * @param Controller $controller
     * @return null|Response
     */
    public function execute(Controller $controller)
    {
        $controller->set('controller_actions', $controller->actions);

        $actionsLoaded = [];
        $actions = $controller->Action->listActions();
        array_walk($actions, function($action) use (&$actionsLoaded, &$controller) {
            $a = $controller->Action->getAction($action);
            $actionsLoaded[$action] = [
                'class' => get_class($a),
                'action_iface' => ($a instanceof ActionInterface),
                'index_iface' => ($a instanceof IndexActionInterface),
                'entity_iface' => ($a instanceof EntityActionInterface),
                'scope' => ($a instanceof BaseEntityAction) ? $a->getScope() : [],
            ];
        });
        $controller->set('loaded_actions', $actionsLoaded);
    }
}