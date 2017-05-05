<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function index () //list of articles     //CRUD functions
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

  public function store (Request $request) //stores article
  {
    $rules = [
      'title' => 'required',
      'body' => 'required',
      'image' => 'required',
  ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(["error" => "You need to fill out all fields."]);
    }

    $category = new Category;

    $category->title = $request->input('title');
    $category->body = $request->input('body');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move('storage/', $imageName);
    $category->image = $request->root().'/storage/'.$imageName;

    $category->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function update ($id, Request $request) //update ourt article
  {
    $category = Category::find($id);

    $category->title = $request->input('title');
    $category->body = $request->input('body');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move('storage/', $imageName);
    $category->image = $request->root().'/storage/'.$imageName;
    $category->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show ($id) //show single article
  {
    $category = Category::find($id);

    return Response::json($category);
  }


  public function destroy ($id) //destroys article
  {
    $category = Category::find($id);

    $category->delete();

    return Response::json(["success" => "Deleted category."]);

  }

}
