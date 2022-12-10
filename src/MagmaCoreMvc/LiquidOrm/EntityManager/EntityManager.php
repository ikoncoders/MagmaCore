<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\LiquidOrm\EntityManager;

use Ikonc\MagmaCoreMvc\LiquidOrm\EntityManager\CrudInterface;
use Ikonc\MagmaCoreMvc\LiquidOrm\EntityManager\EntityManagerInterface;

class EntityManager implements EntityManagerInterface
{

    /**
     * @var CrudInterface
     */
    protected CrudInterface $crud;

    /**
     * Main constructor clas
     * 
     * @return void
     */
    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @inheritDoc
     */
    public function getCrud() : Object
    {
        return $this->crud;
    }

}