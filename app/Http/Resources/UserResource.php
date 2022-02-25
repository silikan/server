<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
          'id' => $this->id,
          'name' => $this->name,
          'email' => $this->email,
          'avatar' => $this->avatar,
          'isAdmin' => $this->isAdmin(),
          'isHandyman' => $this->isHandyman(),
          'isClient' => $this->isClient(),
          'isModerator' => $this->isModerator(),
          'emailVerified' => $this->email_verified_at,
          'username' => $this->username,
          'slug' => $this->slug,
          'url' => $this->url,
          'username' => $this->username,
          'is_available_to_hire' => $this->isavailableToHire(),
          'is_online' => $this->isOnline(),
          'bio' => $this->bio,
          'date_of_birth' => $this->date_of_birth,
          'phone_number' => $this->phone_number,
          'address' => $this->address,
          'country' => $this->country,
          'city' => $this->city,
          'state' => $this->state,
          'zip_code' => $this->zip_code,
          'website' => $this->website,
          'education' => $this->education,
          'certifications' => $this->certifications,
          'experience' => $this->experience,
          'social_links' => $this->social_links,
          'skills' => $this->skills,
          'timestamps' => $this->timestamps,
        ];
    }
}

