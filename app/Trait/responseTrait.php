<?php

namespace App\Trait;
use  Illuminate\Http\JsonResponse;
trait responseTrait
{
    function successResponse($message,$data,$statusCode=201):JsonResponse
    {
        return response()->json([
            'message'=>$message,
            'data'=>$data,
        ],$statusCode);

    }
    function successWithToken($message,$token,$statusCode=201):JsonResponse
    {
        return response()->json([
            'Message'=>$message,
            'Token'=>$token,
            'Status_code'=>$statusCode
        ]);
        
    }
    function ResponseTraitResend($verificationCode):JsonResponse
    {
        return response()->json( [
           'Message'=> 'New VerificVation code sent...',
           'new verification'=>$verificationCode
        ]);
      
     }
     function ResponseTraitVerifiy():JsonResponse
    {
        return response()->json( [
           'Message'=> 'Email verified successfully',
           
        ]);
      
     }
     function resetTrait($Message,$statusCode=201):JsonResponse
     {
         return response()->json( [
            'Message'=>$Message,
            
         ],$statusCode);
       
      }
      function responseTraitOnlyMessage($Message,$statusCode=201):JsonResponse
      {
          return response()->json( [
             'Message'=>$Message,
             
          ],$statusCode);
        
       }
}
