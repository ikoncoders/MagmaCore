<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\LiquidOrm\DataRepository;


use Ikonc\MagmaCoreMvc\Yaml\YamlConfig;
use Ikonc\MagmaCoreMvc\LiquidOrm\LiquidOrmManager;
use Ikonc\MagmaCoreMvc\Base\Exception\BaseUnexpectedValueException;
use Ikonc\MagmaCoreMvc\LiquidOrm\DataMapper\DataMapperEnvironmentConfiguration;

class DataRepositoryFactory
{

    /** @var string */
    protected string $tableSchema;

    /** @var string */
    protected string $tableSchemaID;

    /** @var string */
    protected string $crudIdentifier;

    /**
     * Main class constructor
     *
     * @param string $crudIdentifier
     * @param string $tableSchema
     * @param string $tableSchemaID
     */
    public function __construct(string $crudIdentifier, string $tableSchema, string $tableSchemaID)
    {
        $this->crudIdentifier = $crudIdentifier;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }

    /**
     * Create the DataRepository Object
     *
     * @param string $dataRepositoryString
     * @return void
     * @throws BaseUnexpectedValueException
     */
    public function create(string $dataRepositoryString) : DataRepositoryInterface
    {
        $entityManager = $this->initializeLiquidOrmManager();
        $dataRepositoryObject = new $dataRepositoryString($entityManager);
        if (!$dataRepositoryObject instanceof DataRepositoryInterface) {
            throw new BaseUnexpectedValueException($dataRepositoryString . ' is not a valid repository object');
        }
        return $dataRepositoryObject;
    }

    public function initializeLiquidOrmManager()
    {
        $environmentConfiguration = new DataMapperEnvironmentConfiguration(YamlConfig::file('database'));
        $ormManager = new LiquidOrmManager($environmentConfiguration, $this->tableSchema, $this->tableSchemaID);
        return $ormManager->initialize();
    }

}