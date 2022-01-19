<?php

/**
 * @template T
 */
interface Collection
{
    /**
     * @param T $item
     */
    public function add($item): void;
    /**
     * @return T
     */
    public function get(int $index);

}

class Dog
{
}

class Foo
{
    /**
     * @param Collection<Dog> $dogs
     * @return Collection
     */
    public function setCollection(Collection $dogs): Collection
    {
        return $dogs;
    }
} 