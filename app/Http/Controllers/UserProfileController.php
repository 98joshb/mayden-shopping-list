<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{

    /**
     * Opens the user budget screen
     */
    public function showSetBudgetForm()
    {
        $spending_limit = Auth::user()->spending_limit;
        return view('shopping-list-views.budget', compact('spending_limit'));
    }

    /**
     * Saves user budget to db
     */
    public function saveBudget(Request $request)
    {
        Auth::user()->update([
            'spending_limit' => $request->validate(['spending_limit' => 'nullable|numeric|min:0|max:999999'])['spending_limit']
        ]);

        return redirect()->route('shopping-list.index');
    }
}
