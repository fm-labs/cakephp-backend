<aside class="main-sidebar">
    <section class="sidebar">
        <div class="sidebar-toggle">
            <a href="#" data-sidebar-toggle>
                <i class="fa fa-cubes"></i>
                <span><?= $this->get('be_title') ?></span>
            </a>
        </div>
        <?= $this->fetch('sidebar_items'); ?>
    </section>
    <script>
        // Nightmode: Restore state
        if (!!window.localStorage /*&& window.localStorage.key('be.sidebar')*/) {
            var enabled = window.localStorage.getItem('be.sidebar');
            console.log("Restoring sidebar", enabled);
            if (enabled === true || enabled == 'true') {
                $('body').removeClass('sidebar-collapsed');
            }
        }
        $(document).ready(function() {

            $('[data-sidebar-toggle]').click(function(ev) {
                $('body').toggleClass('sidebar-collapsed');

                if (!!window.localStorage) {
                    console.log("Saving sidebar state", !$('body').hasClass('sidebar-collapsed'));
                    window.localStorage.setItem('be.sidebar', !$('body').hasClass('sidebar-collapsed'));
                }

                ev.preventDefault();
                return false;
            });
        })
    </script>
</aside>