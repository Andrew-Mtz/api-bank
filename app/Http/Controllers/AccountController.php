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
        try {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:accounts'
            ]);
            $account = new Account();
            $account->email = $request->input('email');
            $account->balance = 0;
            $account->save();
            return "cuenta creada correctamente";
        } catch (\Illuminate\Database\QueryException $e) {
            return "Error";
        }
    }

    public function deposito(Request $request)
    {
        $id = $request->input('id');
        $account = Account::where('id', $id)->first();
        try {
            if ($account) {
                $nuevoBalance = $account->balance + $request->input('monto');
                $account->balance = $nuevoBalance;
                $account->save();
                return response()->json("balance actualizado correctamente", 200);
            } else {
                return response()->json("La cuenta con el id proporcionado no existe", 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return "Error";
        } 
    }

    public function retiro(Request $request)
    {
        $id = $request->input('id');
        $account = Account::where('id', $id)->first();
        try {
            if ($account) {
                $monto = $request->input('monto');
                if ($account->balance >= $monto && $monto >= 1000) {
                /* aaaaaaaaaaaaa */
                } else if ($account->balance >= $monto) {
                    $nuevoBalance = $account->balance - $monto;
                    $account->balance = $nuevoBalance;
                    $account->save();
                    return response()->json("retiro realizado correctamente", 200);
                } else {
                    return response()->json("El monto a retirar es mayor al balance de la cuenta", 403);
                }
            } else {
                return response()->json("La cuenta con el id proporcionado no existe", 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return "Error";
        } 
    }

    public function transferencia(Request $request)
    {
        $idOrigen = $request->input('idOrigen');
        $originAccount = Account::where('id', $idOrigen)->first();
        $idDestino = $request->input('idDestino');
        $destinationAccount = Account::where('id', $idDestino)->first();
        try {
            if ($originAccount && $destinationAccount) {
                $monto = $request->input('monto');
                if ($originAccount->balance >= $monto && $monto >= 1000) {
                    echo "en progreso";
                } else if ($originAccount->balance >= $monto) {
                    $destinationAccount->balance = $destinationAccount->balance + $monto;
                    $destinationAccount->save();
                    $originAccount->balance = $originAccount->balance - $monto;
                    $originAccount->save();
                    return response()->json("transferencia realizada correctamente", 200);
                }else {
                    return response()->json("El monto a transferir es mayor al balance de la cuenta", 403);
                }
            } else {
                return response()->json("Los id proporcionados de las cuentas son erroneos", 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return "Error";
        } 
    }

    public function destroy($id)
    {
        Account::destroy($id) ;
        return response()->json(null, 204);
    }
}
