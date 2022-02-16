<?php

namespace App\Http\Controllers\Api;

use App\Services\EmployeeManagement\Employee;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    use ApiResponser;
    protected $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function payroll()
    {
        $data = $this->employee->salary();
    
        return $this->successResponse($data,"success");
    }
}
