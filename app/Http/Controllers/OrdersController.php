<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{

  public function index()
    {
      return File::get('index.html');
    }

  public function store ()
  {
    $rules = [
      'id' => 'required',
      'userID' => 'required',
      'productID' => 'required',
      'amount' => 'required',
      'totalPrice' => 'required',
      'timestamps' => 'required',

    ];


    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(["error" => "You need to fill out all fields."]);

    }

    $order = new Order;

    $order->id = $request->input('id');
    $order->userID = $request->input('userID');
    $order->productID = $request->input('productID');
    $order->amount = $request->input('amount');
    $order->totalPrice = $request->input('totalPrice');
    $order->timestamps = ??
    $order->userID = Auth::user()->id;

    $order->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }
  public function update ($id, Request $request) 
  {
    $order = Order::find($id);

    $order->id = $request->input('id');
    $order->userID = $request->input('userID');
    $order->productID = $request->input('productID');
    $order->amount = $request->input('amount');
    $order->totalPrice = $request->input('totalPrice');
    $order->timestamps = ??
    $order->userID = Auth::user()->id;
    $article->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show ($id)
  {
    $order = Order::find($id);

    return Response::json($order);
  }


  public function destroy ($id)
  {
    $order = Order::find($id);

    $order->delete();

    return Response::json(["success" => "Deleted order."]);

  }

}
