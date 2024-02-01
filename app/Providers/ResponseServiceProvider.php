<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\JsonResponse;

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
        Response::macro("api_ok",function($message="",$resource,$status_code=200){
            $result = [
                "success" => true,
                "message" => $message,
            ];
            if(count($resource) >1){
                $result = array_merge($result,$resource);
            }
            return $result;
        });

        Response::macro("api_fail",function($message="",$data=[],$status_code=400){
            $result = [
                "success" => false,
                "message" => $message,
                "data"=>$data,
            ];
            return response()->json($result,$status_code);
        });
    }
}
