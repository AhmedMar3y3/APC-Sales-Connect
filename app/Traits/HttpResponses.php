<?php 
namespace App\Traits;

trait HttpResponses{

    protected function Success($data, $code = 200){
        return response()->json(
            [
                "message"=> "You have successfully made this request",
                "data"=> $data
                
            ], $code);
    }
    protected function error($data, $code){
        return response()->json([
            "message"=> "An error has occurred ....",
            "data"=> $data
        ], $code);

    }

}
