<?php

namespace Admin\Extend\AdminComposerViewer;

use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminComposerViewer\Extension\Config;
use Admin\Extend\AdminComposerViewer\Extension\Install;
use Admin\Extend\AdminComposerViewer\Extension\Navigator;
use Admin\Extend\AdminComposerViewer\Extension\Uninstall;
use Admin\Extend\AdminComposerViewer\Extension\Permissions;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminComposerViewer
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static $name = "bfg/admin-composer-viewer";

    /**
     * Extension call slug
     * @var string
     */
    static $slug = "bfg_admin_composer_viewer";

    /**
     * Extension description
     * @var string
     */
    public static $description = "Composer Viewer for bfg admin";

    /**
     * @var string
     */
    protected $navigator = Navigator::class;

    /**
     * @var string
     */
    protected $install = Install::class;

    /**
     * @var string
     */
    protected $uninstall = Uninstall::class;

    /**
     * @var string
     */
    protected $permissions = Permissions::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected $config = Config::class;

    public function boot()
    {
        parent::boot();

        $this->mergeConfigFrom(__DIR__ . '/../config/admin-composer-viewer.php', 'admin-composer-viewer');

        $this->publishes([
            __DIR__ . '/../config/admin-composer-viewer.php' => config_path('admin-composer-viewer.php')
        ], ['admin-composer-viewer-config']);
    }
}

