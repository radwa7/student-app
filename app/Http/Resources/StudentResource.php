<?php

namespace App\Http\Resources;
use App\Helpers\PhoneParser;
use Illuminate\Http\Resources\Json\JsonResource;
use Propaganistas\LaravelPhone\PhoneNumber;
class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // $phone= $request->input('phone_number');
        // $mobile = PhoneParser::parse($phone);

        return [
            'status'       =>   Response([])->status(),
            'massage'      =>   "success",
            'full_name'    =>   $this->full_name,
            'phone_number' =>   (string)($this->phone_number),
            'country'      =>   (string)($this->country),
            'country_code' =>   (string)($this->country_code),
            'email'        =>   $this->email,
            'gender'       =>   $this->gender == 1 ? "Male":"Female",
            'is married'   =>   $this->is_married ? 'Yes' : 'No',
            'have_child'   =>   $this->have_child ? 'Yes' : 'No',
            'created_at'   =>   $this->created_at->format('m/d/Y'),

        ];

    }
}
