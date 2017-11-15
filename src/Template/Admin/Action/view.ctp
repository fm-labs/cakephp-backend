<?php
/**
 * View Action
 *
 * Renders entity with EntityView cell
 *
 * View variables:
 * - entity: Entity instance
 * - viewOptions: EntityView options array
 */
$entity = $this->get('entity');
$title = $this->get('title', get_class($entity));
$viewOptions = (array) $this->get('viewOptions');

/**
 * Helpers
 */
$this->loadHelper('Backend.Chosen');
$this->loadHelper('Bootstrap.Tabs');
?>
<div class="view">

    <?php
    echo $this->cell('Backend.EntityView', [ $entity ], $viewOptions)->render('tabs');
    ?>

    <?php
    if ($this->fetch('content')) {
        $this->Tabs->create();
        $this->Tabs->add($this->fetch('title', $title));
        echo $this->fetch('content');
    }
    ?>

    <?php if ($this->get('tabs')): ?>
        <hr />
        <?php foreach ((array) $this->get('tabs') as $tabId => $tab): ?>
            <?php $this->Tabs->add($tab['title'], $tab); ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php echo $this->Tabs->render(); ?>

    <?php if (\Cake\Core\Configure::read('debug')): ?>
        <small><?php echo h(__FILE__); ?></small>
    <?php endif; ?>
</div>
