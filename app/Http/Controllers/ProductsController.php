<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller

{
  public function index ()

  {
    return File::get('index.html');
  }

  {
    $products = Product::orderBy("id", "desc")->take(6)->get();
    foreach($products as $key => $product)
    {
      if(strlen($product->body)>100)
      {
        $category->body = substr($product->body,0,100)."...";

      }
    }
    return Response::json($products);

  }

  public function store (Request $request)
  {
    $rules = [
      "id " => 'required';
      "image" => 'required';
      "price" => 'required';
      "description" => 'required';
      "name" => 'required';
      "categoryID" => 'required';
  ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(["error" => "You need to fill out all fields."]);
    }

    $product = new Product;

    $product->id = $request->input('id');
    $product->name = $request->input('name');
    $product->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function update ($id, Request $request)
  {
    $product = Product::find($id);

    $product->id = $request->input('id');
    $product->name = $request->input('name');
    $product->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show ($id)
  {
    $product = Product::find($id);

    return Response::json($category);
  }


  public function destroy ($id)
  {
    $product = Product::find($id);

    $product->delete();

    return Response::json(["success" => "Deleted product."]);

  }

}
