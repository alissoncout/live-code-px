<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $return =  [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];

        if($this->access_token){
            $return += ['access_token' => $this->access_token];
            $return += ['email_verified_at' => $this->email_verified_at];
        }

        return $return;
    }
}
