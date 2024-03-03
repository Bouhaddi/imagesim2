<?php

namespace App\Domain\Core\Traits;

use Illuminate\Support\Str;

trait ContentTrait
{
    /**
     * This is a smart method to create a slug from a string
     * The method will increment by +1 if slug already found in the database
     * @param string $title
     * @return string
     */
    protected function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);

        // Check if the slug already exists in the database
        $count = $this->getModel()::where('slug', $slug)->count();
        $suffix = 1;

        // If the slug already exists, append a suffix until it's unique
        while ($count > 0) {
            $slug = Str::slug($title) . '-' . $suffix;
            $count = $this->getModel()::where('slug', $slug)->count();
            $suffix++;
        }

        return $slug;
    }

    abstract protected function getModel(): string;
}
