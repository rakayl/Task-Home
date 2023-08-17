<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Request\Deposit;
use App\Http\Request\Withdrawal;
use App\Models\Wallet;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request as GuzzleRequest;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\ServerErrorResponseException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function deposit(Deposit $post)
    {
        $header = $post->header('Authorization');
        if ($header) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $header = base64_decode($matches[1]);
            }else{
                return response()->json(['status'=>0,'message' =>['Bearer Unidentified']]);
            }
        }
       $create =  Wallet::create([
            'order_id'=>$post->order_id,
            'amount'=>$post->amount,
            'full_name'=>$header,
            'timestamp'=>$post->timestamp,
        ]);
        if($create){
        return response()->json(['status'=>1,
        'order_id'=>$post->order_id,
        'amount'=>$post->amount,]);
        }
        return response()->json(['status'=>0,'message' =>['Create Deposit Failed']]);
    }
    public function withdrawal(Withdrawal $post)
    {
        $header = $post->header('Authorization');
        if ($header) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $header = base64_decode($matches[1]);
            }else{
                return response()->json(['status'=>0,'message' =>['Bearer Unidentified']]);
            }
        }
        $check = Wallet::where('full_name',$header)->get()->sum('amount');
        if(!$check){
            return response()->json(['status'=>0,'message' =>['Create Withdrawal Failed, Full name dont have amount ']]);
        }
        if($check < $post->amount){
            return response()->json(['status'=>0,'message' =>['Create Withdrawal Failed, amount max withdrawal = '.$check]]);
        }
       $create =  Wallet::create([
            'order_id'=>$post->order_id,
            'amount'=>-$post->amount,
            'full_name'=>$header,
            'timestamp'=>$post->timestamp,
        ]);
        if($create){
        return response()->json(['status'=>1,
        'order_id'=>$post->order_id,
        'amount'=>$post->amount,]);
        }
        return response()->json(['status'=>0,'message' =>['Create Deposit Failed']]);
    }

}
