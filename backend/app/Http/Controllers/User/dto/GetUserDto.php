<?php

namespace App\Http\Controllers\User\dto;

use App\Http\Controllers\Build\dto\GetBuildDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class GetUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string          $id,
        public string          $firstName,
        public string          $lastName,
        public string          $email,
        #[DataCollectionOf(GetBuildDto::class)]
        public ?DataCollection $builds
    )
    {
    }
}
    
