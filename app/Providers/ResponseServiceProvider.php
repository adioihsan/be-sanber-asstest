<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // define default api response template
        Response::macro("api_ok",function($message="",$data=[],$status_code=200){
            $response = [
                "success" => true,
                "message" =>$response = [
                    $success = "false",
                    $message = $message,
                    $data=$data,
                ],
                "data"=>$data,
            ];
            return response()->json($response,$status_code);
        });
        Response::macro("api_fail",function($message="",$data=[],$status_code=400){
            $response = [
                "success" => false,
                "message" => $message,
                "data"=>$data,
            ];
            return response()->json($response,$status_code);
        });
    }
}
