<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\Session;

use Ikonc\MagmaCoreMvc\Yaml\YamlConfig;
use Ikonc\MagmaCoreMvc\Session\SessionFactory;
use Magma\Session\Storage\NativeSessionStorage;

class SessionManager
{

    /**
     * Create an instance of our session factory and pass in the default session storage
     * we will fetch the session name and array of options from the core yaml configuration
     * files
     *
     * @return void
     */
    public static function initialize() : Object
    {
        $factory = new SessionFactory();
        return $factory->create('magmacore', NativeSessionStorage::class, YamlConfig::file('session'));
    }

}