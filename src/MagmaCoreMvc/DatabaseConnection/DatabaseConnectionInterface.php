<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\DatabaseConnection;

 use PDO;

interface DatabaseConnectionInterface
{

    /**
     * Create a new database connection
     * 
     * @return PDO
     */
    public function open() : PDO;

    /**
     * Close database connection
     */
    public function close() : void;

}