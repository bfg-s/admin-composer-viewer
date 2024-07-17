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
    public static string $name = "bfg/admin-composer-viewer";

    /**
     * Extension call slug
     * @var string
     */
    static string $slug = "bfg_admin_composer_viewer";

    /**
     * Extension description
     * @var string
     */
    public static string $description = "Composer Viewer for bfg admin";

    /**
     * @var string
     */
    protected string $navigator = Navigator::class;

    /**
     * @var string
     */
    protected string $install = Install::class;

    /**
     * @var string
     */
    protected string $uninstall = Uninstall::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected string|ConfigExtensionProvider $config = Config::class;

    public function boot(): void
    {
        parent::boot();

        $this->mergeConfigFrom(__DIR__ . '/../config/admin-composer-viewer.php', 'admin-composer-viewer');

        $this->publishes([
            __DIR__ . '/../config/admin-composer-viewer.php' => config_path('admin-composer-viewer.php')
        ], ['admin-composer-viewer-config']);
    }
}

