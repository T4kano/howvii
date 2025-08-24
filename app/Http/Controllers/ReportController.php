<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function loadAll()
    {
        $rows = DB::table('payments as p')
            ->join('properties as pr', 'pr.id', '=', 'p.property_id')
            ->join('property_types as pt', 'pt.id', '=', 'pr.property_type_id')
            ->join('customers as c', 'c.id', '=', 'p.customer_id')
            ->select([
                'p.id as id_sale',
                'p.paid_at as payment_date',
                'p.amount as payment_amount',
                'pr.id as property_code',
                'pr.description as property_description',
                'pt.name as property_type',
                'c.id as customer_id',
                'c.name as customer_name',
            ])->get();


        return collect($rows);
    }
}

