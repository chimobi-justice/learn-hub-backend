<?php

namespace App\Trait;

trait HandlesSlug
{
     /**
    * Automatically update the slug when the title changes, but only on update (not on creation).
    *
    * @param string $value
    */
    public function setTitleAttribute($value)
    {
        // Check if the title is set and has been changed
        if (array_key_exists('title', $this->attributes) && $this->attributes['title'] !== $value) {
            $this->attributes['title'] = $value;

            // Only reset the slug if the model already exists (i.e., it's an update)
            if ($this->exists) {
                $this->attributes['slug'] = null;
            }
        } else {
            // Set the title for the first time (during creation)
            $this->attributes['title'] = $value;
        }
    }
}
