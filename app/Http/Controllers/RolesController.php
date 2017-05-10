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
use App\Role

class RolesController extends Controller
{
  public function index()
  {
    $roles = Role::all();
    return Response::json($roles);
  }

  public function store(Request $request)
  {
    $rules = [
      "roleID" => 'required',
      "name" => 'required',
  ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
          return Response::json(["error" => "You need to fill out all fields."]);
        }

    $role = new Role;
      $role->roleID = $request->input('roleID');
      $role->name = $request->input('name');
    $role->save();

    return Response::json(["success" => "Congrats, You did it."]);
  }


  public function update($id, Request $request)
  {
    $rules = [
      "roleID" => 'required',
      "name" => 'required',
  ];

  $validator = Validator::make(Purifier::clean($request->all()), $rules);
      if($validator->fails())
        {
          return Response::json(["error" => "You need to fill out all fields."]);
        }

    $role = Role::find($id);
      $role->roleID = $request->input('roleID');
      $role->name = $request->input('name');
    $role->save();

    return Response::json(["success" => "Congrats, You did it."]);

  }


  public function show($id)
  {
    $role = Role::find($id);
      return Response::json($role);
  }


  public function destroy($id)
  {
    $role = Role::find($id);
    $role->delete();
      return Response::json(["success" => "Deleted Role."]);

  }
}
