<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Employee;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use ApiResponser;
    protected $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function apply(Request $request)
    {
        $data = $this->employee->applyJob();
        
        return $this->successResponse($data,"success");
    }
}
