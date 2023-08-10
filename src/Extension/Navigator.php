<?php

namespace Admin\Extend\AdminComposerViewer\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminComposerViewer\ComposerViewerController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminComposerViewer\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->item(
            'Composer viewer',
            'composer_viewer',
            [ComposerViewerController::class, 'index']
        )->icon_network_wired()->dontUseSearch();
    }
}
