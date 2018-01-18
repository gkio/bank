<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\Customer;


class CustomerController extends Controller
{
    /**
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function new_customer($name)
    {
        if(empty($name))
            return response()
                    ->json(['status' => 'must be filled name']);

        $customer = new Customer();

        $customer->name = $name;
        $customer->save();


        return response()
            ->json(['customerId' => $customer->id]);
    }
}
