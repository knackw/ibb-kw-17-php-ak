<?php

declare (strict_types=1);

class UserDao extends GenericDao {
    
    public function __construct() {
        parent::__construct('user', 'User');
    }

    protected function getCreateSql(): string {
        
    }

    protected function getCreateArray(object $dto): array {
        
    }

    protected function getUpdateSql(): string {
        
    }

    protected function getUpdateArray($dto): array {
        
    }

}