<?php

declare (strict_types=1);

abstract class GenericDao {
    
    private PDO $connection;
    private ?PDOStatement $readAllStatement = null;
    private ?PDOStatement $readOneStatement = null;
    private ?PDOStatement $createStatement = null;
    private ?PDOStatement $updateStatement = null;
    private ?PDOStatement $deleteStatement = null;
    
    private string $tableName;
    private string $className;
    
    public function __construct(string $tableName, string $className) {
        $this->connection = DbConnection::getInstance()->getConnection();
        $this->tableName = $tableName;
        $this->className = $className;
    }

    function readAll(): array {

        if ($this->readAllStatement == null) {
            $sql = 'SELECT * FROM `' . $this->tableName . '`';
            $this->readAllStatement = $this->connection->prepare($sql);
        }
        
        $this->readAllStatement->execute();

        $dtos = [];
        while ($dto = $this->readAllStatement->fetchObject($this->className)) {
            $dtos[] = $dto;
        }

        return $dtos;
    }

    function readOne(int $id): ?object {

        if ($this->readOneStatement == null) {
            $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE `id`=:id';
            $this->readOneStatement = $this->connection->prepare($sql);
        }
        
        $this->readOneStatement->execute(['id' => $id]);

        $dto = $this->readOneStatement->fetchObject($this->className);
        return $dto ? $dto : null;
    }

    function create(object $dto): bool {

        if ($this->createStatement == null) {
            $sql = $this->getCreateSql();
            $this->createStatement = $this->connection->prepare($sql);
        }
        
        $this->createStatement->execute($this->getCreateArray($dto));
        $dto->setId(intval($this->connection->lastInsertId()));
        return $this->createStatement->rowCount() == 1;
    }
    protected abstract function getCreateSql(): string;
    protected abstract function getCreateArray(object $dto): array;
    

    function update(object $dto): bool {

        if ($dto->getId() == 0) {
            return false;
        }
        
        if ($this->updateStatement == null) {
            $sql = $this->getUpdateSql();
            $this->updateStatement = $this->connection->prepare($sql);
        }
        
        $this->updateStatement->execute($this->getUpdateArray($dto));
        return $this->updateStatement->rowCount() == 1;
    }
    protected abstract function getUpdateSql(): string;
    protected abstract function getUpdateArray($dto): array;

    function delete($dto) {
        
        if ($dto->getId() == 0) {
            return false;
        }
        
        if ($this->deleteStatement == null) {
            $sql = 'DELETE FROM `' . $this->tableName . '` WHERE `id`=:id';
            $this->deleteStatement = $this->connection->prepare($sql);
        }
        
        $this->deleteStatement->execute(['id' => $dto->getId()]);
        return $this->deleteStatement->rowCount() == 1;
    }

    // -------------------------------------------------------------------------
    
    protected function getConnection(): PDO {
        return $this->connection;
    }

    protected function getTableName(): string {
        return $this->tableName;
    }

    protected function getClassName(): string {
        return $this->className;
    }

}
