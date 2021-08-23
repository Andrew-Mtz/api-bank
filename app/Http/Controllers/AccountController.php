<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return Account::all();
    }

    public function show($id)
    {
        return Account::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:accounts'
        ]);
        $account = Account::create($request->all());
        return response()->json($account, 201);
    }

    public function update(Request $request, $id)
    {
/*         switch ($evento) {
            case 'deposito':
                $account = Account::find($id);
                echo $account;
                break;
            case 'retiro':
                # code...
                break;
            case 'transferencia':
                # code...
                break;
                        
            default:
                # code...
                break;
        } */
        $account = Account::find($id);
        $account->update($request->all());
        echo $request;
/*         $account->update($request->all());
        return response()->json($account, 200); */
    }

    public function destroy($id)
    {
        Account::destroy($id) ;
        return response()->json(null, 204);
    }
}
