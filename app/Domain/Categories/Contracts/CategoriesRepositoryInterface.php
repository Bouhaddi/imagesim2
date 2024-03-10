<?php

/**
 * Dedicated for Posts categories, any new features should start from here
 */

namespace App\Domain\Categories\Contracts;

interface CategoriesRepositoryInterface
{
    public function all();

    public function create($categoryData);

    public function find($categoryId);

    public function update($categoryId, $categoryData);

    public function destroy($categoryId);
}
