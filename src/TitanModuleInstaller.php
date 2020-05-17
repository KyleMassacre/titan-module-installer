<?php

namespace KyleMassacre\TitanModuleInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class TitanModuleInstaller extends LibraryInstaller
{

    const DEFAULT_ROOT = "extensions";

    public function supports($packageType)
    {
        return "titan-extension" === $packageType;
    }

    /**
     * @param \Composer\Package\PackageInterface $package
     * @return string
     * @throws \Exception
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getBaseInstallationPath() . '/' . $this->getModuleName($package);
    }

    /**
     * Get the module name, i.e. "joshbrw/something-module" will be transformed into "Something"
     * @param PackageInterface $package
     * @return string
     * @throws \Exception
     */
    protected function getModuleName(PackageInterface $package)
    {
        return $package->getName();

    }

    /**
     * Get the base path that the module should be installed into.
     * Defaults to Modules/ and can be overridden in the module's composer.json.
     * @return string
     */
    protected function getBaseInstallationPath()
    {
        if (!$this->composer || !$this->composer->getPackage()) {
            return self::DEFAULT_ROOT;
        }

        $extra = $this->composer->getPackage()->getExtra();

        if (!$extra || empty($extra['extension-dir'])) {
            return self::DEFAULT_ROOT;
        }

        return $extra['extension-dir'];
    }
}
