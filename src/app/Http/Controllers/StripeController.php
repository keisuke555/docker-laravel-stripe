<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function option () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_OPTION');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        dump($checkout_session);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }
    public function right () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_PLAN_RIGHT');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        dump($checkout_session);


        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }
    public function business () 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $priceId = env('STRIPE_ITEM_PLAN_BUSINESS');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        dump($checkout_session);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
        return redirect($checkout_session->url, 303, [], true);
    }

    // サブスクリプションの実装サンプル！
    public function register (Request $request) 
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // フォームから取得する内容
        // 顧客名：CloudMeetsのユーザー名から自動補完
        // メール：CloudMeetsのユーザー名から自動補完
        // 決済方法：フォーム画面で登録したクレジット情報のトークン（実態はStripeに保持されてる）
        // 一度でもCloudMeetsで決済したことあれば、Stripe側の顧客情報（＆決済方法）と紐付けが済んでるので、デフォルトで画面にセットする
        // 決済方法を変更したい場合もあると思うので、「決済情報を修正する」みたいな導線も必要かも。
        $name = $request['name'];
        $email = $request['email'];
        $token = $request['token'];
        Log::debug($token);

        // 顧客情報の登録
        $customer = \Stripe\Customer::create([
            'payment_method' => $token,
            'name' => $name,
            'email' => $email,
            'invoice_settings' => [
                'default_payment_method' => $token,
            ],
        ]);
        // 顧客IDをDB保持
        // 決済方法は顧客IDに紐づいてStripe側で持ってる
        Log::debug($customer);

        // サブスクの登録
        $subscription = \Stripe\Subscription::create([
            'customer' => $customer->id,
            'items' => [
                ['price' => env('STRIPE_ITEM_PLAN_BUSINESS')],
            ],
        ]);
        // サブスクIDをDB保持
        // プラン変更時のサブスク停止などに使用する
        Log::debug($subscription);
        
        return view('success');
    }
}
