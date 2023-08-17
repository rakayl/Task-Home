<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\ServerErrorResponseException;
use DB;

class Wallets extends Component
{
    public $wallets, $order_id, $amount, $wallet_id,$full_name,$type,$url,$create,$amounts;

    protected $listeners = [
        'deleteWallet'=>'destroy'
    ];
    // Validation Rules
    protected $rules = [
        'full_name' => 'required',
        'order_id' => 'required',
        'amount' => 'required|min:1',
    ];
    public function render()
    {
        $this->amounts = Wallet::select('full_name',DB::raw('
                SUM(
                    CASE WHEN amount IS NOT NULL THEN amount
                        ELSE 0 END
                ) as total_amount
            '))->groupby('full_name')->get();
        $this->wallets = Wallet::select('id','order_id','amount','full_name','timestamp')->latest()->get();
        return view('livewire.wallet');
    }
    public function resetFields(){
        $this->full_name = '';
        $this->order_id = '';
        $this->amount = '';
        $this->type = '';
        $this->url = '';
        $this->create = '';
    }
    public function store(){
        try{
            $header = base64_encode($this->full_name);
            $post = array(
                'order_id'=>$this->order_id,
                'amount'=>$this->amount,
                'timestamp'=>date('Y-m-d H:i:s')
            );
            if($this->type == 'withdrawal'){
                $url = 'withdrawal';
            }else{
                $url = 'deposit';
            }
            $create = $this->postCLient($header,$url,$post);
            if($create['status']==1){
             $message = 'Wallet '.$this->type.' successfully!!';

            $this->resetFields();
            }else{
               $message = implode(" ", $create['message']);
            }
            session()->flash('message', $message);
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while creating Wallet!!');
            $this->resetFields();
        }
    }
    public function postCLient($header,$url, $post){
        $api = env('APP_URL_API');
        $client = new Client();

        $ses = 'Bearer '.$header;

        $content = array(
        'headers' => [
            'Authorization' => $ses,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'ip-address-view' => \Request::ip(),
            'user-agent-view' => $_SERVER['HTTP_USER_AGENT'],
        ],
        'json' => (array) $post
        );

        try {
            $response = $client->post($api . 'api/' . $url, $content);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            try {
                if ($e->getResponse()) {
                    $response = $e->getResponse()->getBody()->getContents();

                    return json_decode($response, true);
                } else {
                    return ['status' => 0, 'messages' =>  'Check your internet connection.'];
                }
            } catch (Exception $e) {
                return ['status' => 0, 'messages' =>'Check your internet connection.'];
            }
        }
    }
}
