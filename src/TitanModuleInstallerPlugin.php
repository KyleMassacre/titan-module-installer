<?php

namespace KyleMassacre\TitanModuleInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class TitanModuleInstallerPlugin implements PluginInterface
{

    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new TitanModuleInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
