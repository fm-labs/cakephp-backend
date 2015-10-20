<?php
/**
 * Created by PhpStorm.
 * User: flow
 * Date: 5/25/15
 * Time: 6:05 PM
 */

namespace Backend\View;

use Cake\View\View;

class BackendView extends View
{
    public function initialize()
    {
        $this->helpers = [
            'Html',
            'Form' => [
                'templates' => 'Backend.form_templates',
                'widgets' => [
                    'button' => ['Backend\View\Widget\ButtonWidget'],
                    //'select' => ['Backend\View\Widget\ChosenSelectBoxWidget'],
                    'htmleditor' => ['Backend\View\Widget\HtmlEditorWidget'],
                    'htmltext' => ['Backend\View\Widget\HtmlTextWidget'],
                    'datepicker' => ['Backend\View\Widget\DatePickerWidget'],
                    'timepicker' => ['Backend\View\Widget\TimePickerWidget'],
                ]
            ],
            'Paginator' => [
                'templates' => 'Backend.paginator_templates'
            ],
            'Backend.Backend',
            'Backend.Ui',
            'Backend.Toolbar'
        ];

        $this->loadHelper('Html');

        $this->Html->css('Backend.semanticui/semantic.min', ['block' => true]);
        $this->Html->css('Backend.chosen/chosen.min', ['block' => true]);
        $this->Html->css('Backend.pickadate/themes/classic', ['block' => true]);
        $this->Html->css('Backend.pickadate/themes/classic.date', ['block' => true]);
        $this->Html->css('Backend.pickadate/themes/classic.time', ['block' => true]);
        $this->Html->css('Backend.admin', ['block' => true]);

        $beScript = <<<SCRIPT
var _backendConf = {
    rootUrl: '{{ROOTURL}}'
};
var _backend = (function (conf) {
    return {
        rootUrl: conf.rootUrl
            }
    })(_backendConf);
SCRIPT;
        $beScript = str_replace(['{{ROOTURL}}'], [$this->Url->build('/')], $beScript);
        $this->Html->scriptBlock($beScript, ['block' => true]);

        $this->Html->script('Backend.jquery/jquery-1.11.2.min', ['block' => true]);

        $this->Html->script('Backend.semanticui/semantic.min', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.tinymce/tinymce.min', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.tinymce/jquery.tinymce.min', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.chosen/chosen.jquery.min', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.pickadate/picker', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.pickadate/picker.date', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.pickadate/picker.time', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.be-ui', ['block' => 'scriptBottom']);
        $this->Html->script('Backend.be-widgets', ['block' => 'scriptBottom']);
    }
}
