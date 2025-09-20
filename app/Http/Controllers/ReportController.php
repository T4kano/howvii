<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'pr.id as property_id',
                'pr.name as property_name',
                'pr.description as property_description',
                'pt.name as property_type',
                'c.id as customer_id',
                'c.name as customer_name',
            ])->get();


        return collect($rows);
    }

    // a) Lista com id de cada imóvel e soma de todos os pagamentos
    public function totalsByProperty()
    {
        $data = $this->loadAll()->groupBy('property_id')
            ->map(function ($items, $id) {
                return [
                    'id'    => $id,
                    'name'  => $items->first()->property_name,
                    'value' => $items->sum('payment_amount'),
                ];
            })
            ->values(); // força array sequencial

        return response()->json($data);
    }


    // b) Lista com cada mês/ano e o total de vendas no período
    public function totalsByMonth()
    {
        $data = $this->loadAll()
            ->groupBy(function ($row) {
                return Carbon::parse($row->payment_date)->format('m/Y');
            })
            ->map(function ($items, $monthYear) {
                return [
                    'date'  => $monthYear,
                    'value' => $items->sum('payment_amount'),
                ];
            })
            ->values();

        return response()->json($data);
    }


    // c) Lista com cada tipo de imóvel e seu percentual no total de vendas (quantitativo)
    public function typeShare()
    {
        $all = $this->loadAll();
        $totalSales = $all->count();

        $data = $all->groupBy('property_type')
            ->map(function ($items, $type) use ($totalSales) {
                $count = $items->count();
                $percent = $totalSales > 0 ? round(($count / $totalSales) * 100, 2) : 0;
                return [
                    'type'    => $type,
                    'percent' => (float) $percent,
                ];
            })
            ->values();

        return response()->json($data);
    }
}
