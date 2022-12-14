<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\Session\Storage;

use Ikonc\MagmaCoreMvc\Session\Storage\AbstractSessionStorage;


class NativeSessionStorage extends AbstractSessionStorage
{

    /**
     * Main class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param [type] $value
     * @return void
     */
    public function setSession(string $key, $value) : void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param [type] $value
     * @return void
     */
    public function setArraySession(string $key, $value) : void
    {
        $_SESSION[$key][] = $value;
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param [type] $default
     * @return void
     */
    public function getSession(string $key, $default = null)
    {
        if ($this->hasSession($key)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return void
     */
    public function deleteSession(string $key) : void
    {
        if ($this->hasSession($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @inheritdoc
     *
     * @return void
     */
    public function invalidate() : void
    {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setCookie($this->getSessionName(), '', time() - $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_unset();
        session_destroy();
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param [type] $default
     * @return void
     */
    public function flush(string $key, $default = null)
    {
        if ($this->hasSession($key)) {
            $value = $_SESSION[$key];
            $this->deleteSession($key);
            return $value;    
        }
        return $default;

    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return boolean
     */
    public function hasSession(string $key) : bool
    {
        return isset($_SESSION[$key]);
    }


}