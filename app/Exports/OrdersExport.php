<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::where('users_id', $this->id)->get();
    }
}
