<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PlaceResource;

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
        // $image='';
        if( strpos( $this->avatar, 'http://' ) !== false) {
            $image=$this->avatar;
            
        }
        else{
            $image="http://".$_SERVER['HTTP_HOST']."/storage/".$this->avatar;
            
            }


        return[
            "id"=>$this->id,
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "email"=>$this->email,
            "mobile"=>$this->mobile,
            "avatar"=>$image,
            "national_id"=>$this->national_id,
            "role"=>$this->role,
            "place"=> new PlaceResource($this->place),
            "password"=>$this->password,
            "password_confirmation"=>$this->password,
        ];
        
    }
}
