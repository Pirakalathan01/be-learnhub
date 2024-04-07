<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class UserLimitedResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'role' => $this->roles ? new RoleResource($this->roles->first()) : null,
        ];
    }
}
