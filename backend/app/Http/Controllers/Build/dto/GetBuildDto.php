<?php

namespace App\Http\Controllers\Build\dto;

use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Http\Controllers\User\dto\GetUserDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class GetBuildDto extends Data
{
    public function __construct(
        public int            $id,
        public string         $name,
        public ?string        $description,
        public ?GetUserDto    $user,
        public bool           $isReady,
        #[DataCollectionOf(GetComponentDto::class)]
        public DataCollection $components,
    )
    {
    }
}
