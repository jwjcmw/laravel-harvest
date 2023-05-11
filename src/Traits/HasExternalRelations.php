<?php

namespace Byte5\LaravelHarvest\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait HasExternalRelations
{
    abstract protected function getExternalRelations(): array;

    public function loadExternal(array|string $relations = '*', bool $save = true): static
    {
        // normalize input
        if ($relations === '*') {
            $relations = $this->getExternalRelations();
        }

        $this->mapRelations(
            $this->filterRelations(
                (array)$relations
            ),
            $save
        );

        return $this;
    }

    private function filterRelations(array $relations): Collection
    {
        return collect($relations)->filter(fn($relation) =>
                $this->relationExists($relation)
                && $this->relationHasNotBeenEstablished($relation)
        );
    }

    private function relationExists(string $relation): bool
    {
        $externalRelations = $this->getExternalRelations();
        return in_array($relation, $externalRelations, true) || Arr::has($externalRelations, $relation);
    }

    private function relationHasNotBeenEstablished(string $relation): bool
    {
        return null === $this->{$relation} || null === $this->{'external_' . Str::snake($relation) . '_id'};
    }

    private function mapRelations(Collection $relations, bool $save = false): void
    {
        $relations->each(function ($relation) use ($save) {
            $relationId = $this->{'external_' . Str::snake($relation) . '_id'};

            $relationKey = $this->getRelationKey($relation);

            if ($existingModel = $this->checkForLocalExistence($relationKey, $relationId)) {
                return $this->$relationKey()->associate($existingModel);
            }

            $relationModel = call_user_func('Harvest::' . $relationKey)
                                ->find($relationId)
                                ->toCollection()
                                ->first();

            if ($save && config('harvest.uses_database')) {
                $relationModel->save();
            }

            $this->$relationKey()->associate($relationModel);
        });
    }

    /**
     * Checks for the local existence of the model via external_id.
     */
    private function checkForLocalExistence(string $modelKey, int $id): ?Model
    {
        if (! config('harvest.uses_database')) {
            return null;
        }

        $modelMethod = '\\Byte5\\LaravelHarvest\\Models\\' . Str::ucfirst(Str::camel($modelKey)) . '::whereExternalId';
        return $modelMethod($id)->first();
    }

    /**
     * Returns the key of the passed in relation.
     */
    private function getRelationKey(string $relation): string
    {
        $externalRelations = $this->getExternalRelations();
        return in_array($relation, $externalRelations, true)
            ? $relation : $externalRelations[$relation];
    }
}
