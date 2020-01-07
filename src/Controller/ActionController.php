<?php

namespace Backend\Controller;

use Backend\Action\Interfaces\ActionInterface;
use Cake\Controller\Controller;
use Cake\Controller\Exception\MissingActionException;
use Cake\Event\Event;
use LogicException;

class ActionController extends Controller
{
    public $controller;

    public $action;

    public $autoRender = true;

    /**
     * @param Controller $controller The parent controller instance
     * @param ActionInterface $action The action class instance
     */
    public function __construct(Controller $controller, ActionInterface $action)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->eventManager($this->controller->eventManager());
        //$this->components($this->controller->components());
        //$this->components()->setController($this->controller);
        $this->setRequest($this->controller->request);
        $this->response = $this->controller->response;
    }

    /**
     * {@inheritDoc}
     */
    public function invokeAction()
    {
        $request = $this->request;
        if (!isset($request)) {
            throw new LogicException('No Request object configured. Cannot invoke action');
        }
        if (!$this->isAction($request->params['action'])) {
            throw new MissingActionException([
                'controller' => $this->name . "Controller",
                'action' => $request->params['action'],
                'prefix' => isset($request->params['prefix']) ? $request->params['prefix'] : '',
                'plugin' => $request->params['plugin'],
            ]);
        }

        return $this->controller->Action->execute($request->params['action']);
    }

    public function isAction($action)
    {
        return $this->controller->Action->hasAction($action);
    }

    /**
     * {@inheritDoc}
     */
    public function __get($key)
    {
        return $this->controller->{$key};
    }

    /**
     * {@inheritDoc}
     */
    public function __set($key, $val)
    {
        return $this->controller->{$key} = $val;
    }

    /**
     * Magic call wrapper
     *
     * @param string $method Method name
     * @param array $args Method args
     * @return mixed
     */
//    public function __call($method, $args)
//    {
//        return call_user_func_array([$this->controller, $method], $args);
//    }

    /**
     * {@inheritDoc}
     */
    public function render($view = null, $layout = null)
    {
        $response = $this->controller->render($view, $layout);
        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatchEvent($name, $data = null, $subject = null)
    {
        if ($subject === null) {
            $subject = $this->controller;
        }

        return parent::dispatchEvent($name, $data, $subject);
    }
}
