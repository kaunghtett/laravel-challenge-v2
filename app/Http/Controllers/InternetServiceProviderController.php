<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    use ApiResponser;

    public function getMptInvoiceAmount(Request $request)
    {
        $amount = $this->invoiceAmount(new Mpt(), $request->get('month'));
       
        return $this->successResponse($amount,"success");
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $amount = $this->invoiceAmount(new Ooredoo(), $request->get('month'));
        return $this->successResponse($amount,"success");
    }

    public static function invoiceAmount($service, $month = 1) {
        $service->setMonth($month);
        $amount = $service->calculateTotalAmount();
        return $amount;
    }
}
