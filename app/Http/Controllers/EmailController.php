<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Show the email sending form.
     */
    public function index($id)
    {
        return view('email-form', compact('id')); // A view to display the email form
    }

    /**
     * Send email to the specified recipient.
     */
    public function sendEmail(Request $request, $shoppingListId)
    {
        $validated = $request->validate([
            'recipient' => 'required|email',
        ]);

        $recipientEmail = $validated['recipient'];

        $shoppingList = ShoppingList::with(['items' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->find($shoppingListId);


        $data = [
            'shoppingList' => $shoppingList,
            'totalAmount' => $shoppingList->items->sum(function ($item) {
                return $item->price * $item->quantity;
            })
        ];

        Mail::send('emails.view', $data, function ($message) use ($recipientEmail) {
            $message->to($recipientEmail)
                ->subject('Your Shopping List');
        });

        return redirect()->route('shopping-list.index')->with('success', 'Email sent successfully');
    }
}
