<div class="container-fluid text-center">

    <h2 class="form-signin-heading">
        <i class="fa fa-cubes fa-3x"></i>
    </h2>

    <div class="alert alert-warning">
        <?= __('Your session has expired. Please login again to continue.'); ?>
    </div>

    <?= $this->Form->create(null, [
        'class' => 'form-signin',
        'horizontal' => false,
        'url' => ['plugin' => 'Backend', 'controller' => 'Auth', 'action' => 'login']
    ]); ?>
    <?= $this->Form->input('username', [
        'label' => false,
        'placeholder' => __d('backend','Username')
    ]); ?>
    <?= $this->Form->input('password', [
        'type' => 'password',
        'label' => false,
        'placeholder' => __d('backend','Password')
    ]); ?>
    <?= $this->Form->button(__d('backend','Login'), [
        'class' => 'btn btn-lg btn-primary btn-block'
    ]); ?>
    <?= $this->Form->end(); ?>

</div> <!-- /container -->