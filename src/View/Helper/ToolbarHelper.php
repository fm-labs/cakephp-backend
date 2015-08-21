<?php
namespace Backend\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;

/**
 * Class ToolbarHelper
 * @package Backend\View\Helper
 * @property HtmlHelper $Html
 */
class ToolbarHelper extends Helper
{
    public $helpers = ['Html'];

    protected $_defaultConfig = [
        'toolbar_element' => 'Backend.Toolbar/toolbar',
        'toolbar_class' => 'be-toolbar',
        'item_class' => 'be-toolbar-item',
        'item_element' => 'Backend.Toolbar/item',
        'block' => 'toolbar'
    ];

    protected $_items = [];

    protected $_rendered = false;

    protected $_grouping = false;

    /**
     * Reset to default config settings and clear items
     */
    public function reset()
    {
        $this->_items = [];
        $this->_rendered = false;
        $this->_grouping = false;
        $this->config($this->_defaultConfig, null, false);
    }

    /**
     * Create a new toolbar.
     * Clears items and optionally applies a custom config
     *
     * @param array $config
     */
    public function create($config = [])
    {
        $this->_items = [];
        $this->_rendered = false;
        $this->_grouping = false;
        $this->config($config);
    }

    /**
     * Add a new toolbar item (link).
     * @param $title
     * @param null $url
     * @param array $attr
     */
    public function addLink($title, $url = null, $attr = [])
    {
        if ($this->_grouping === true) {
            return;
        }
        $this->_items[] = compact('title', 'url', 'attr');
    }

    /**
     * Add a new toolbar item (post-link).
     * @param $title
     * @param null $url
     * @param array $attr
     */
    public function addPostLink($title, $url = null, $attr = [])
    {
        //@TODO Implement toolbar form post link item
        $this->addLink($title, $url, $attr);
    }

    /**
     * Experimental! Item grouping
     * @param $title
     * @param array $options
     */
    public function startGroup($title, $options = [])
    {
        $this->_grouping = true;
    }

    /**
     * Experimental! Item grouping
     */
    public function endGroup()
    {
        $this->_grouping = false;
    }

    /**
     * Render toolbar into view block (configurable block name).
     * Optionally, set option ['inline' => true] to output html.
     *
     * Options:
     * - inline => false Set to true to return rendered html
     * - block => config:block Customize view block name
     * - [custom] Options will be passed to the toolbar element template,
     *              so additional parameters can be passed to the template
     *
     * @param array $options
     * @return string
     */
    public function render($options = [])
    {
        $options = array_merge([
            'inline' => false,
            'block' => $this->config('block')
        ], $options);

        // if ($this->_grouping) {
        //      $this->endGroup();
        // }

        $html = $this->_View->element($this->config('toolbar_element'), [
            'items' => $this->_items,
            'config' => $this->config(),
            'options' => $options
        ]);

        if ($options['inline'] === true) {
            return $html;
        }

        //if ($this->_rendered === true) {
        //    return;
        //}

        $this->_View->assign($options['block'], $html);
        $this->_rendered = true;
    }

    /**
     * Automatically trigger the rendering method before rendering the layout,
     * if the toolbar has not been rendered yet
     */
    public function beforeLayout()
    {
        if ($this->_rendered === false && !empty($this->_items)) {
            $this->render();
        }
    }

    /**
     * Trigger rendering method by self invocation
     */
    public function __invoke($options = [])
    {
        return $this->render($options);
    }
}