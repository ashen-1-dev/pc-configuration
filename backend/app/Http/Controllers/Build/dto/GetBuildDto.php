<?php

namespace App\Http\Controllers\Build\dto;

use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Http\Controllers\User\dto\GetUserDto;
use App\Models\Build\Build;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
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

    public static function fromModelCollection(Collection $builds): Collection
    {
        return $builds->map(fn(Build $build) => self::fromModel($build));
    }

    public static function fromModel(Build|Model $build): GetBuildDto
    {
        return new GetBuildDto(
            id: $build->id,
            name: $build->name,
            description: $build->description,
            user: GetUserDto::from($build->user),
            isReady: $build->is_ready,
            components: GetComponentDto::fromModelCollection($build->components),
        );
    }
}
