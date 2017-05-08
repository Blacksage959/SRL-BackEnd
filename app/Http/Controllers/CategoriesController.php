<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function index ()
  {
    $categories = Category::orderBy("id", "desc")->take(6)->get();
    foreach($categories as $key => $category)
    {
      if(strlen($category->body)>100)
      {
        $category->body = substr($category->body,0,100)."...";

      }
    }
    return Response::json($categories);

  }

  public function store (Request $request)
  {
    $rules = [
      'id' => 'required',
      'name' => 'required',

  ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(["error" => "You need to fill out all fields."]);
    }

    $category = new Category;

    $category->id = $request->input('id');
    $category->name = $request->input('name');
    $category->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function update ($id, Request $request)
  {
    $category = Category::find($id);

    $category->id = $request->input('id');
    $category->name = $request->input('name');
    $category->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show ($id)
  {
    $category = Category::find($id);

    return Response::json($category);
  }


  public function destroy ($id)
  {
    $category = Category::find($id);

    $category->delete();

    return Response::json(["success" => "Deleted category."]);

  }

}
