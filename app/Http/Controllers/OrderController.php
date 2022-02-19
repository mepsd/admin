<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use LDAP\Result;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function export(Request $request)
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders.csv',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
        ];


        $callback = function () {
            $orders = Order::all();

            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, ['id', 'first_name', 'last_name', 'email', 'total', 'itemCount', 'orderItems']);

            // Add rows
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->first_name,
                    $order->last_name,
                    $order->email,
                    $order->total,
                    $order->orderItems->count(),
                    $order->orderItems->map(function ($item) {
                        return $item->product->title;
                    })->implode(', '),
                ]);
            }
            fclose($file);
        };
        return \Response::stream($callback, 200, $headers);
    }
}
