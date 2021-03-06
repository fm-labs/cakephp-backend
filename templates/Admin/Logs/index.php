<?php $this->loadHelper('Bootstrap.Tabs'); ?>
<div class="index">

    <?php $this->Tabs->create(); ?>
    <?php $this->Tabs->add(__d('admin', 'LogViewer')); ?>
    <h2><?= __d('admin', 'LogViewer'); ?></h2>
    <table class="ui table striped">
        <thead>
        <tr>
            <th><?= __d('admin', 'Logfile'); ?></th>
            <th><?= __d('admin', 'Filesize'); ?></th>
            <th><?= __d('admin', 'Last modified'); ?></th>
            <th><?= __d('admin', 'Last access'); ?></th>
            <th class="actions"><?= __d('admin', 'Actions'); ?></th>
        </tr>
        </thead>
        <?php foreach ($this->get('files') as $file) : ?>
            <tr>
                <td><?= $this->Html->link($file['name'], ['action' => 'view', $file['id']]); ?></td>
                <td><?= $this->Number->toReadableSize($file['size']); ?></td>
                <td><?= $this->Time->timeAgoInWords($file['last_modified']); ?></td>
                <td><?= $this->Time->timeAgoInWords($file['last_access']); ?></td>

                <td class="actions">
                    <?= $this->Html->link(
                        __d('admin', 'View'),
                        ['action' => 'view', $file['id']],
                        ['class' => 'btn btn-sm btn-default', 'data-icon' => 'file-txt-o']
                    ) ?>
                    <?= $this->Ui->link(
                        __d('admin', 'Clear'),
                        ['action' => 'clear', $file['id']],
                        ['class' => 'btn btn-sm btn-default', 'data-icon' => 'trash']
                    ) ?>
                    <?= $this->Ui->postLink(
                        __d('admin', 'Delete'),
                        ['action' => 'delete', $file['id']],
                        ['class' => 'btn-danger btn-default btn-sm btn', 'data-icon' => 'trash', 'confirm' => __d('admin', 'Are you sure you want to delete {0}?', $file['name'])]
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <?php $this->Tabs->add(__d('admin', 'Log Rotation')); ?>
    <h2><?= __d('admin', 'Log Rotation'); ?></h2>
    <table class="ui table striped">
        <thead>
        <tr>
            <th><?= __d('admin', 'Alias'); ?></th>
            <th><?= __d('admin', 'Path'); ?></th>
            <th><?= __d('admin', 'Keep'); ?></th>
            <th><?= __d('admin', 'Schedule'); ?></th>
            <th><?= __d('admin', 'Compress'); ?></th>
            <th><?= __d('admin', 'Compress Delay'); ?></th>
            <th><?= __d('admin', 'Rotate Empty'); ?></th>
            <th><?= __d('admin', 'Email To'); ?></th>
            <th class="actions"><?= __d('admin', 'Actions'); ?></th>
        </tr>
        </thead>
        <?php foreach ($this->get('logRotation') as $alias => $config) : ?>
            <tr>
                <td><?= $alias; ?></td>
                <td><?= $config['path']; ?></td>
                <td><?= $config['keep']; ?></td>
                <td><?= $config['schedule']; ?></td>
                <td><?= $config['compress']; ?></td>
                <td><?= $config['compress_delay']; ?></td>
                <td><?= $config['rotate_empty']; ?></td>
                <td><?= $config['email_to']; ?></td>
                <td class="actions">
                    <ul>
                        <li><?= $this->Html->link('Rotate', ['action' => 'rotate', $alias]) ?></li>
                        <li><?= $this->Html->link('Force', ['action' => 'rotate', $alias, 'force' => true]); ?></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php $this->Tabs->add(__d('admin', 'Debug'), ['debugOnly' => true]); ?>
    <?php debug($this->get('files')); ?>

    <?php echo $this->Tabs->render(); ?>
</div>