<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'city' => $this->city,
            'created_at' => $this->created_at
        ];
    }

    public function with($request)
    {
        return [
            'version' => '2.0.0',
            'attribution' => url('/terms-of-service'),
            'valid-as-of' => date('D, d M Y H:i:s')
        ];
    }
}
