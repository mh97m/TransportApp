<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        // $query = auth()->user()->driverOrders();
        $query = Order::where('driver_id', auth()->user()->id);

        $query->with([
            'cargo',
            'cargo.originProvince',
            'cargo.destinationProvince',
            'cargo.originCity',
            'cargo.destinationCity',
            'cargo.carType',
            'cargo.loaderType',
        ]);

        $orders = $query
            ->paginate(20);

        return Inertia::render('Orders/All', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function updateOrderStatus(Order $order, Request $request)
    {
        abort_if(! $order->cargo->owner->is(auth()->user()), 404);  

        $order->update([
            'owner_status' => $request->isAccepted,
        ]);

        if ($request->isAccepted) {
            Order::query()
                ->where('ulid', '!=', $order->ulid)
                ->where([
                    'cargo_id' => $order->cargo_id,
                ])
                ->delete();

            $order->cargo->update([
                'completed_at' => now(),
            ]);

            return $this->flashAlert(
                icon: 'success',
                text: 'بار با موفقیت تایید شد',
                timer: 3000,
                confirmButtonText: 'تایید',
            );
        }

        return $this->flashAlert(
            icon: 'error',
            text: 'بار با موفقیت رد شد',
            timer: 3000,
            confirmButtonText: 'تایید',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        return Inertia::render('Orders/Index', [
            // 'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
