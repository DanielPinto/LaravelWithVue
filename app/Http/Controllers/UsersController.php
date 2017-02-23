<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function vueCrud(){
      return view('/vuejscrud/users');
    }

    public function index()
    {
        $items = User::latest()->paginate(6);
        $response = [
          'pagination' => [
            'total' => $items->total(),
            'per_page' => $items->perPage(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem()
          ],
          'data' => $items
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required',
          'email' => 'required',
          'password' => 'required',
        ]);
        $create = User::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
      ]);
      $edit = User::find($id)->update($request->all());
      return response()->json($edit);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['done']);
    }
}
