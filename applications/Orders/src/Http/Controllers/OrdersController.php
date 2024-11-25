<?php

namespace Rezyon\Applications\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Rezyon\Applications\Orders\Http\Requests\OrderDetailRequest;
use Rezyon\Applications\Orders\Http\Resources\OrderDetailCollection;
use Rezyon\Applications\Orders\Http\Resources\OrderResource;
use Rezyon\Applications\Orders\Http\Resources\OrdersCollection;
use Rezyon\Carts\Services\CartService;
use Rezyon\Orders\Services\OrderService;
use Rezyon\Users\UserService;

class OrdersController extends \App\Http\Controllers\Controller
{
    public function getOrders(
        Request $request,
        OrderService $service
    )
    {
        return new OrdersCollection($service->getOrders($request->user()->id));
    }

    public function orderDetail(
        OrderDetailRequest $request,
        OrderService $service,
        UserService $userService
    )
    {
        return new OrderResource([
            "group" => $userService->getPnrGroup($request->user()->pnr, $request->user()->companies_id),
            "order" => $service->getOrderDetails($request->input('id'), $request->input('cart'))
        ]);
    }
}
