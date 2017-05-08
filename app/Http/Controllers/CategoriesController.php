<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Hash;
use Response;
use App\Category;
use JWTAuth;
use File;

class CategoriesController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return Response::json($categories);

  }

  public function store(Request $request)
  {
    $rules = [
      'name' => 'required',

  ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
          return Response::json(["error" => "You need to fill out all fields."]);
        }

    $category = new Category;
      $category->name = $request->input('name');
      $category->save();
    return Response::json(["success" => "Congrats, You did it."]);
  }


  public function update($id, Request $request)
  {

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
          return Response::json(["error" => "You need to fill out all fields."]);
        }

    $category = Category::find($id);
      $category->name = $request->input('name');
      $category->save();
    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show($id)
  {
    $category = Category::find($id);

    return Response::json($category);
  }


  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();
  return Response::json(["success" => "Deleted category."]);

  }

}
