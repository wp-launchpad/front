<?php

namespace LaunchpadFront;

use LaunchpadBudAssets\Assets;
use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadFilesystem\WPFilesystemDirect;
use League\Container\Definition\Definition;

/**
 * Service provider.
 */
class ServiceProvider extends AbstractServiceProvider
{
    /**
     * Registers items with the container
     *
     * @return void
     */
    public function define()
    {
        $this->register_service(WPFilesystemDirect::class);

        $this->register_service(Assets::class, function (Definition $definition) {
            $definition
                ->addArgument($this->getContainer()->get(WPFilesystemDirect::class))
                ->addArgument($this->getContainer()->get('plugin_slug'))
                ->addArgument($this->getContainer()->get('assets_url'))
                ->addArgument($this->getContainer()->get('plugin_version'))
                ->addArgument($this->getContainer()->get('plugin_launcher_file'));
        });
    }
}