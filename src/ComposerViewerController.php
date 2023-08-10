<?php

namespace Admin\Extend\AdminComposerViewer;

use Admin\Components\ModelTableComponent;
use Admin\Page;
use App\Admin\Controllers\Controller;
use App\Admin\Delegates\Card;
use App\Admin\Delegates\SearchForm;
use App\Admin\Delegates\ModelTable;

class ComposerViewerController extends Controller
{
    /**
     * @param Page $page
     * @param Card $card
     * @param SearchForm $searchForm
     * @param ModelTable $modelTable
     * @return Page
     */
    public function index(Page $page, Card $card, SearchForm $searchForm, ModelTable $modelTable) : Page
    {
        //dd($this->getComposerPackages());

        return $page->card(
            $card->model_table(
                $modelTable->perPage(500),
                $modelTable->model($this->getComposerPackages()),
                $modelTable->col('Package name', 'name')->sort(),
                $modelTable->col('Direct dependency', 'direct-dependency')->sort()->yes_no,
                $modelTable->col('Current version', 'version'),
                $modelTable->col('Latest version', 'latest'),
                $modelTable->col('Latest status', function (array $model) {
                    return ModelTableComponent::callExtension('badge', [$model['latest-status'], [$model['label']]]);
                })->sort(),
                $modelTable->col('Description', 'description')->sort(),
            ),
        );
    }

    private function getComposerPackages()
    {
        $which_composer = config('admin-composer-viewer.composer-path', '/usr/local/bin/composer');
        try {
            $command = 'cd ' . base_path() . '; export COMPOSER_HOME='.$which_composer.'./.config/composer; ' . $which_composer . ' show --latest --format=json ';
            exec($command, $output);
            $packages = json_decode(implode('', $output), true)['installed'];

            foreach ($packages as &$package) {
                switch ($package['latest-status']) {
                    case 'up-to-date':
                        $package['label'] = 'success';
                        break;
                    case 'update-possible':
                        $package['label'] = 'warning';
                        break;
                    case 'semver-safe-update':
                        $package['label'] = 'danger';
                        break;
                }
            }
            return $packages;
        } catch (\Exception $e) {
            return [];
        }
    }
}
