<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;

/**
 * Automatically load app's backend configuration
 *
 * Copy backend.default.php to your app's config folder,
 * rename to backend.php and adjust contents
 */
Configure::load('Backend.backend');

Plugin::load('Bootstrap');

/*if (Plugin::loaded('Banana')) {
    \Banana\Banana::register('Backend', new \Backend\BackendPlugin());
}*/