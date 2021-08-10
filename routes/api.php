<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Account;

/* Route::post('accounts', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Account::all();
}); */

Route::get('balance/{id}', function($id) {
    return Account::find($id);
});

Route::post('deposito', function(Request $request, $id) {
    $account = Account::findOrFail($id);
    $account->create($request->all());

    return $account;
});

Route::post('retiro', function(Request $request, $id) {
    $account = Account::findOrFail($id);
    $account->update($request->all());

    return $account;
});

Route::delete('accounts/{id}', function($id) {
    Account::find($id)->delete();

    return 204;
});
