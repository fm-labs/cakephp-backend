<?php
/**
 * Edit Action Admin Template
 */
$entity = $this->get('entity');
//$title = $this->get('title', @array_pop(explode('\\', get_class($entity))));
$viewOptions = (array)$this->get('viewOptions');

$formOptions = $this->get('form.options', []);
$inputFields = $this->get('fields', []);
$inputOptions = $this->get('inputs.options', []);
$fieldsets = $this->get('fieldsets');
$translations = $this->get('translations.languages');
/**
 * Helpers
 */
$this->loadHelper('Bootstrap.Tabs');
?>
<div class="form form-edit">

    <?php if ($translations) : ?>
    <div>
        <p>
            <strong>Translations: </strong>
            <?php foreach ($translations as $lang => $langLabel) : ?>
                <?php
                $options = [
                    'data-lang' => $lang,
                    'data-title' => __d('backend', 'Edit {0} translation', $langLabel),
                    'class' => ($lang == Cake\I18n\I18n::locale()) ? 'active' : ''
                ];
                $langLabel = ($lang == Cake\I18n\I18n::locale()) ? '[' . $langLabel . ']' : $langLabel;
                ?>
                <?= $this->Html->link($langLabel, ['action' => 'edit', $entity->id, 'translation' => $lang], $options); ?>&nbsp;
            <?php endforeach; ?>
        </p>
    </div>
    <?php endif; ?>

    <?php //echo $this->cell('Backend.EntityView', [ $entity ], $viewOptions)->render();
    echo $this->Form->create($entity, $formOptions);
    if ($fieldsets) {
        foreach ($fieldsets as $fieldset) {
            $fieldset += ['fields' => [], 'legend' => true, 'options' => []];
            echo $this->Form->fieldsetStart($fieldset['legend'], $fieldset['options']);
            foreach ($fieldset['fields'] as $field => $fieldConfig) {
                if (is_numeric($field)) { //@todo Normalize fields in action class
                    $field = $fieldConfig;
                    $fieldConfig = [];
                }
                echo $this->Form->input($field, $fieldConfig);
            }
            echo $this->Form->fieldsetEnd();
        }
    } else {
        echo $this->Form->allInputs($inputFields, $inputOptions);
    }
    echo $this->Form->submit(__d('backend', 'Save changes'));
    echo $this->Form->end();
    ?>


    <?php if ($this->get('tabs')) : ?>
        <?php $this->Tabs->create(); ?>
        <?php foreach ((array)$this->get('tabs') as $tabId => $tab) : ?>
            <?php $this->Tabs->add($tab['title'], $tab); ?>
        <?php endforeach; ?>
        <?php echo $this->Tabs->render(); ?>
    <?php endif; ?>

</div>
