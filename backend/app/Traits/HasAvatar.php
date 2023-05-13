<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use URL;

trait HasAvatar
{
    public string $avatarCollectionName = 'avatar';
    public string $defaultAvatarUrl = '/storage/default-user-avatar.png';
    public bool $hasDefaultAvatar = true;


    public function avatar(): MediaCollection
    {
        return $this->getMedia($this->avatarCollectionName);
    }

    public function addAvatar(UploadedFile $image): Media
    {
        return $this->addMedia($image)->toMediaCollection($this->avatarCollectionName);
    }

    public function getAvatarUrl(): string|null
    {
        $url = $this->getFirstMediaUrl($this->avatarCollectionName);
        if (!$url && $this->hasDefaultAvatar) {
            $url = URL::to('/') . $this->defaultAvatarUrl;
        }

        return $url;
    }

    public function hasAvatar(): bool
    {
        return isset($this->getMedia($this->avatarCollectionName)[0]);
    }

    public function removeAvatar(): void
    {
        if ($this->hasAvatar()) {
            $this->getMedia($this->avatarCollectionName)->first()->delete();
        }
    }

}
