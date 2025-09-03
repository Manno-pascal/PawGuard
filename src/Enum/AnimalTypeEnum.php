<?php

namespace App\Enum;

enum AnimalTypeEnum: string
{
    case ANIMAL_TYPE_DOG = 'dog';
    case ANIMAL_TYPE_CAT = 'cat';
    case ANIMAL_TYPE_RABBIT = 'rabbit';
    case ANIMAL_TYPE_HAMSTER = 'hamster';
    case ANIMAL_TYPE_GUINEA_PIG = 'guinea_pig';
    case ANIMAL_TYPE_FERRET = 'ferret';
    case ANIMAL_TYPE_PARROT = 'parrot';
    case ANIMAL_TYPE_CANARY = 'canary';
    case ANIMAL_TYPE_BUDGIE = 'budgie';
    case ANIMAL_TYPE_TURTLE = 'turtle';
    case ANIMAL_TYPE_SNAKE = 'snake';
    case ANIMAL_TYPE_LIZARD = 'lizard';
    case ANIMAL_TYPE_FISH = 'fish';
    case ANIMAL_TYPE_FROG = 'frog';
    case ANIMAL_TYPE_HEDGEHOG = 'hedgehog';
    case ANIMAL_TYPE_CHINCHILLA = 'chinchilla';
    case ANIMAL_TYPE_GOAT = 'goat';
    case ANIMAL_TYPE_CHICKEN = 'chicken';

    public static function getAnimalTypeList(): array
    {
        return array_column(self::cases(), 'value');
    }


}
