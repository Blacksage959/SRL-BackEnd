<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Hash;
use Response;
use App\Order;
use JWTAuth;
use File;
use Auth;
use App\Product

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth', ['only' => ['store','update','destroy']]);
  }


  public function index()
  {
    $orderss = Order::all();
    return Response::json($orders);
  }

  public function store(Request $request)
  {
    $rules = [

      'userID' => 'required',
      'productID' => 'required',
      'amount' => 'required',
      'totalPrice' => 'required',
      'comment' => 'required',
    ];


    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
            return Response::json(["error" => "You need to fill out all fields."]);
        }

      $product = Product::find($request->input('productID'));
        if(empty($product))
          {
            return Response::json(["" => ""]);
          }
          if($product->availability == 0)
            {
              return Response::json(["" => ""]);
            }

    $order = new Order;
      $order->userID = Auth::user()->id;
      $order->productID = $request->input('productID');
      $order->amount = $request->input('amount');

      $order->totalPrice = $request->input('amount') * $product->price;
      $order->comment = $request->input('comment');

    $order->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function update($id, Request $request)
  {

    $rules = [

      'userID' => 'required',
      'productID' => 'required',
      'amount' => 'required',
      'totalPrice' => 'required',
      'comment' => 'required',
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
            return Response::json(["error" => "You need to fill out all fields."]);
        }


    $order = Order::find($id);
      $order->userID = Auth::user()->id;
      $order->productID = $request->input('productID');
      $order->amount = $request->input('amount');
      $order->totalPrice = $request->input('totalPrice');
      $order->comment = $request->input('comment');

    $order->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show($id)
  {
    $order = Order::find($id);
    return Response::json($order);
  }


  public function destroy($id)
  {
    $order = Order::find($id);
    $order->delete();

    return Response::json(["success" => "Deleted order."]);
  }

}
