<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        return[
            "id"=>$this->id,
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "email"=>$this->email,
            "mobile"=>$this->mobile,
            "avatar"=>$this->avatar,
            "national_id"=>$this->national_id,
            "role"=>$this->role,
            "access_token"=> $this->tokens[0]->token
        ];
        
    }
}
