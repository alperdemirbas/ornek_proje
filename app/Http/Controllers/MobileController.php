<?php

namespace App\Http\Controllers;

use App\Http\Models\MobilCheck as MobileCheck;
use App\Http\Requests\MobilRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MobileController extends Controller
{

    protected $mobilCheck;
    protected $store;

    public function __construct()
    {
        $this->mobilCheck = MobileCheck::first();
        $this->store = json_decode($this->mobilCheck->store ?? '', true);
    }

    public function version()
    {
        $data = [
            'platforms' => $this->store,
            'deadlock' => $this->mobilCheck->deadlock
        ];
        return view("mobile.version", $data);
    }

    public function update(Request $request)
    {

        $this->store['android'] = [
                'store_url' => $this->store['android']['store_url'],
                'store_id' => $this->store['android']['store_id'],
                'current_version' => $this->store['android']['current_version'],
                'supported_version'=> $this->store['android']['supported_version']
            ];

        $this->store['ios']  = [
                'store_url'=> $this->store['ios']['store_url'],
                'store_id'=> $this->store['ios']['store_id'],
                'current_version' => $this->store['ios']['current_version'],
                'supported_version'=>$this->store['ios']['supported_version'],
            ];

        if (isset($request->deadlock)){
            MobileCheck::where("id", 1)->update(["deadlock" => $request->deadlock]);
        }

        if(isset($request->android)){
            $this->store['android'] = [
                'store_url'=>$request->android["'store_url'"],
                'store_id' =>$request->android["'store_id'"],
                'current_version' => $request->android["'current_version'"],
                'supported_version'=>$request->android["'supported_version'"]
            ];

            MobileCheck::where("id", 1)->update(["store" => json_encode($this->store)]);
        }
        else if($request->ios){
            $this->store['ios']  = [
                'store_url'=>$request->ios["'store_url'"],
                'store_id' =>$request->ios["'store_id'"],
                'current_version' => $request->ios["'current_version'"],
                'supported_version'=>$request->ios["'supported_version'"]
            ];

            MobileCheck::where("id", 1)->update(["store" => json_encode($this->store)]);
        }

        return redirect()->back();

    }

    public function check(MobilRequest $request)
    {
        $time = Carbon::now();
        switch ($request->platform) {
            case 'TargetPlatform.iOS':

                if ($this->mobilCheck->deadlock == 'none') {
                    $deadlock = false;
                } else if ($this->mobilCheck->deadlock == 'all' || $this->mobilCheck->deadlock == 'ios') {
                    $deadlock = true;
                } else if ($this->mobilCheck->deadlock == 'android') {
                    $deadlock = false;
                }


                if ($request->version < $this->store['ios']['supported_version']) {
                    $status = "force";
                } else if ($request->version >= $this->store['ios']['supported_version'] and $request->version < $this->store['ios']['current_version']) {
                    $status = "update";
                } else if ($request->version >= $this->store['ios']['supported_version'] and $request->version <= $this->store['ios']['current_version']) {
                    $status = "latest";
                } else {
                    $status = "fail";
                }
                $response =
                    [
                        'store_url' => $this->store['ios']['store_url'],
                        'store_id' => $this->store['ios']['store_id'],
                        'supported_version' => $this->store['ios']['supported_version'],
                        'deadlock' => $deadlock,
                        'version_number' => $this->store['ios']['current_version'],
                        'status' => $status, //[update,force,latest],
                        'date_time'=>$time->toDateTimeString(),
                    ];
                break;

            case 'TargetPlatform.android':
                if ($this->mobilCheck->deadlock == 'none') {
                    $deadlock = false;
                } else if ($this->mobilCheck->deadlock == 'all' || $this->mobilCheck->deadlock == 'android') {
                    $deadlock = true;
                } else if ($this->mobilCheck->deadlock == 'ios') {
                    $deadlock = false;
                }
                if ($request->version < $this->store['android']['supported_version']) {
                    $status = "force";
                } else if ($request->version >= $this->store['android']['supported_version'] and $request->version < $this->store['android']['current_version']) {
                    $status = "update";
                } else if ($request->version >= $this->store['android']['supported_version'] and $request->version <= $this->store['android']['current_version']) {
                    $status = "latest";
                } else {
                    $status = "fail";
                }
                $response =
                    [
                        'store_url' => $this->store['android']['store_url'],
                        'store_id' => $this->store['android']['store_id'],
                        'supported_version' => $this->store['android']['supported_version'],
                        'deadlock' => $deadlock,
                        'version_number' => $this->store['android']['current_version'],
                        'status' => $status, //[update,force,latest],
                        'date_time'=>$time->toDateTimeString()
                    ];
                break;

            default:
                $response = 'Platform Tanımsız';
                break;
        }

        return response()->json($response);
    }
}
