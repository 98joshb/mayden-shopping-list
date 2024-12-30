<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $shoppingList = ShoppingList::with(['items' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->where('user_id', Auth::user()->id)->first();

        // Calculate the total amount by summing the price of each item
        $totalAmount = 0;
        if ($shoppingList && !$shoppingList->items->isEmpty()) {
            $totalAmount = $shoppingList->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        }

        // Check if the total amount exceeds the spending limit
        $alertMessage = null;
        if ($user->spending_limit && $totalAmount > $user->spending_limit) {
            $alertMessage = 'Total amount exceeds your spending limit of £' . $user->spending_limit . '!';
        }


        return view('shopping-list', compact('alertMessage', 'shoppingList'));
    }

    /**
     * Show the form for creating  a new resource.
     */
    public function create()
    {
        $message = "Add an item to your shopping list!";
        return view('shopping-list-views.form', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($itemId)
    {
        $message = "Edit your shopping list!";
        $item = ShoppingListItem::find($itemId);
        return view('shopping-list-views.form', compact('message', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $shoppingList = ShoppingList::firstOrCreate([
            'user_id' => Auth::user()->id,
        ]);

        $existingItem = $shoppingList->items()->where('description', $request->description)->first();

        if ($existingItem) {
            return back()->withErrors([
                'description' => 'This description already exists in your shopping list.',
            ])->withInput();
        }

        $nextPosition = $shoppingList->items()->max('order') + 1;
        $shoppingList->items()->create([
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'order' => $nextPosition,
        ]);

        return redirect()->route('shopping-list.index')->with('success', 'Item added successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedRequest = $request->validate([
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $item = ShoppingListItem::findOrFail($id);

        if (ShoppingListItem::where('description', $validatedRequest['description'])->where('id', '!=', $id)->exists()) {
            return back()->withErrors([
                'description' => 'This description already exists in your shopping list.'
            ])->withInput();
        }

        $item->update($validatedRequest);

        return redirect()->route('shopping-list.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemId)
    {
        $item = ShoppingListItem::findOrFail($itemId);
        $shoppingList = $item->shoppingList;

        $item->delete();

        // Delete shopping list if empty
        $shoppingList->items()->count() === 0 && $shoppingList->delete();

        return redirect()->route('shopping-list.index')->with('success', 'Item deleted successfully!');
    }

    public function checkItem(Request $request, $id)
    {
        $item = ShoppingListItem::findOrFail($id);
        $item->update(['checked' => !$item->checked]);

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        foreach ($request->input('itemIds') as $index => $itemId) {
            ShoppingListItem::where('id', $itemId)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
