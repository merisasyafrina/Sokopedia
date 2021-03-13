<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\TransactionDetails;
use App\TransactionHeaders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Carbon\carbon;

class TransactionController extends Controller
{
    public function add($id)
    {

        $product = Product::where('id', $id)->firstOrFail();
        return view('add-to-cart', ['product' => $product]);
    }

    public function order(Request $request, $id)
    {

        $product = Product::where('id', $id)->firstOrFail();

        $check = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
        if (empty($check)) {
            $transaction = new TransactionHeaders;
            $transaction->userId = Auth::user()->id;
            $transaction->status = 0;
            $transaction->totalPrice = 0;
            $transaction->save();
        }

        $newTransaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();

        $checkdetail = TransactionDetails::where('productId', $product->id)->where('transactionHeaderId', $newTransaction->id)->first();

        if (empty($checkdetail)) {
            $tdetail = new TransactionDetails;
            $tdetail->transactionHeaderId = $newTransaction->id;
            $tdetail->productId = $product->id;
            $tdetail->quantity = $request->quantity;
            $tdetail->totalPrice = $product->price * $request->quantity;
            $tdetail->save();
        } else {
            $tdetail = TransactionDetails::where('productId', $product->id)->where('transactionHeaderId', $newTransaction->id)->first();
            $tdetail->quantity += $request->quantity;
            $tdetail->totalPrice += $product->price * $request->quantity;
            $tdetail->update();
        }

        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
        $transaction->totalPrice += $product->price * $request->quantity;
        $transaction->update();

        $products = DB::table('products')->paginate(3);
        return view('home', ['product' => $products]);
    }

    public function index()
    {

        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
        if ($transaction != null) {
            $tdetail = TransactionDetails::where('transactionHeaderId', $transaction->id)->get();
            return view('cart', ['transaction' => $transaction, 'tdetail' => $tdetail]);
        }
        return view('cart');
    }

    public function delete($id)
    {

        $tdetail = TransactionDetails::where('id', $id)->first();
        $transaction = TransactionHeaders::where('id', $tdetail->transactionHeaderId)->first();
        $transaction->totalPrice = $transaction->totalPrice - $tdetail->totalPrice;
        $transaction->update();
        $tdetail->delete();

        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
        if ($transaction != null) {
            $tdetail = TransactionDetails::where('transactionHeaderId', $transaction->id)->get();
            return view('cart', ['transaction' => $transaction, 'tdetail' => $tdetail]);
        }
        return view('cart');
    }

    public function checkout()
    {
        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();
        if ($transaction != null) {
            $transaction->status = 1;
            $transaction->update();
            $tdetail = TransactionDetails::where('transactionHeaderId', $transaction->id)->get();
            return view('cart', ['transaction' => $transaction, 'tdetail' => $tdetail]);
        }
        return view('cart');
    }

    public function editPage($id)
    {

        $tdetail = TransactionDetails::where('id', $id)->firstOrFail();
        return view('edit', ['tdetail' => $tdetail]);
    }

    public function edit(Request $request, $id)
    {

        $tdetail = TransactionDetails::where('id', $id)->firstOrFail();
        $product = Product::where('id', $tdetail->productId)->firstOrFail();
        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 0)->first();

        $transaction->totalPrice -= $product->price * $tdetail->quantity;
        $transaction->update();

        $tdetail->quantity = $request->quantity;
        $tdetail->totalPrice = $product->price * $request->quantity;
        $tdetail->update();

        $transaction->totalPrice += $product->price * $request->quantity;
        $transaction->update();

        if ($transaction != null) {
            $tdetail = TransactionDetails::where('transactionHeaderId', $transaction->id)->get();
            return view('cart', ['transaction' => $transaction, 'tdetail' => $tdetail]);
        }
        return view('cart');
    }



    public function history()
    {
        $transaction = TransactionHeaders::where('userId', Auth::user()->id)->where('status', 1)->get()->sortByDesc('updated_at');
        if ($transaction->first()) {
            return view('history', ['transaction' => $transaction]);
        }
        return view('history');
    }

    public function detailTransaction($id)
    {
        $transaction = TransactionHeaders::find($id);
        $tdetail = TransactionDetails::where('transactionHeaderId', $transaction->id)->get();
        return view('detail-transaction', compact('transaction', 'tdetail'));
    }
}
