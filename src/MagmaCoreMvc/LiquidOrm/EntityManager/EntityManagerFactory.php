<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\LiquidOrm\EntityManager;


use Ikonc\MagmaCoreMvc\LiquidOrm\EntityManager\EntityManager;
use Ikonc\MagmaCoreMvc\LiquidOrm\DataMapper\DataMapperInterface;
use Ikonc\MagmaCoreMvc\Base\Exception\BaseUnexpectedValueException;
use Ikonc\MagmaCoreMvc\LiquidOrm\QueryBuilder\QueryBuilderInterface;


class EntityManagerFactory
{

    /** @var DataMapperInterface */
    protected DataMapperInterface $dataMapper;

    /** @var QueryBuilderInterface */
    protected QueryBuilderInterface $queryBuilder;

    /**
     * Main class constructor
     *
     * @param DataMapperInterface $dataMapper
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Create the entityManager obejct and inject the dependency which is the crud object
     *
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @param array $options
     * @return EntityManagerInterface
     * @throws BaseUnexpectedValueException
     */
    public function create(string $crudString, string $tableSchema, string $tableSchemaID, array $options = []) : EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID, $options);
        if (!$crudObject instanceof CrudInterface) {
            throw new BaseUnexpectedValueException($crudString . ' is not a valid crud object.');
        }
        return new EntityManager($crudObject);
    }

}