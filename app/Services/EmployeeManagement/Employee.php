<?php

namespace App\Services\EmployeeManagement;

class Employee implements EmployeeInterface
{
    public function applyJob(): bool
    {
        return true;
    }
    
    public function salary(): int
    {
        return 200;
    }
}