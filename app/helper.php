<?php

namespace App\Helpers;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;
use Brick\PhoneNumber\PhoneNumberFormat;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Propaganistas\LaravelPhone\PhoneNumber as LaravelPhonePhoneNumber;

class PhoneParser
{

    public static function parse($phone){
        $mobile = $phone['phone'];
        $code = $phone['code'];
        $country = $phone['country'];

        $specialChars = ['*', '-', '\\', '\'', '"', '.', '=', '␉', '_', '/', '☆',' ','&','+'];
        $number = str_replace($specialChars, "", $mobile);
        $number = trim($number, " ");

        $number = self::removeZero($number);




            if(strlen($number)<=10){

                $code =self::checkNum($number);

            }else{
                if(str_starts_with($number, '20')){
                    $number = substr($number, 2);
                    $code = '20';
                }elseif(str_starts_with($number, '44')){
                    $number = substr($number, 2);
                    $code = '44';
                }elseif(str_starts_with($number, '966')){
                    $number = substr($number, 3);
                    $code = '966';
                }else {
                    throw new HttpResponseException(response()->json([
                        'status'  => false,
                        'message' => 'invalid number'
                    ], 422));
                }

                $number = self::removeZero($number);
                $code =self::checkNum($number);

            }

            if ($phone['code']!==null && $phone['code']!== $code) {
                throw new HttpResponseException(response()->json([
                    'status'  => false,
                    'message' => "number and code don't match"
                ], 422));
            }

            $country = self::getCountry($code);

            if ($phone['country']!=="" && $phone['country']!== $country) {
                throw new HttpResponseException(response()->json([
                    'status'  => false,
                    'message' => "the number and code don't match the country"
                ], 422));
            }

            $mobile = $number;


        if($code != 'NA'){
            $code = '+'.$code;
        }

            $all = [
                'phone'   => $mobile,
                'code'    => $code,
                'country' => $country
            ];

        return $all;
    }

    public function getCountry($code)
    {
        if($code == '20'){
            $country = 'EGY';
        }elseif($code == '966'){
            $country = 'KSA';
        }elseif($code == '44'){
            $country = 'UK';
        }
        // else{
        //     $country = 'NA';
        // }
        return $country;

    }

    public function removeZero($num)
    {

        if(str_starts_with($num, '00')){
            $num = substr($num, 2);
        }

        elseif(str_starts_with($num, '0')){
            $num = substr($num, 1);
        }

        return $num;
    }

    public function checkNum($number)
    {
        if(str_starts_with($number, '10')||str_starts_with($number, '11')||str_starts_with($number, '12')||str_starts_with($number, '15')){
            if(strlen($number)==10){
            $code = "20";
            }else{
                throw new HttpResponseException(response()->json([
                    'status'  => false,
                    'message' => 'number must be 11 numbers'
                ], 422));
            }
        }elseif(str_starts_with($number, '7')){
            if(strlen($number)==10){
                $code = "44";
            }else{
                throw new HttpResponseException(response()->json([
                    'status'  => false,
                    'message' => 'number must be 11 numbers'
                ], 422));
            }
        }elseif(str_starts_with($number, '5')){
            if(strlen($number)==9){
                $code ="966";
            }else{
                throw new HttpResponseException(response()->json([
                    'status'  => false,
                    'message' => 'number must be 9 numbers'
                ], 422));
            }
        }else{
            throw new HttpResponseException(response()->json([
                'status'  => false,
                'message' => 'invalid number'
            ], 422));
        }
        return $code;
    }

}
