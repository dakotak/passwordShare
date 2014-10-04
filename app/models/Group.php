<?php

class Group extends Eloquent
{

    /**
     * Get the user who created the group
     */
    public function creator()
    {
        return $this->belongsTo('User', 'created_by', 'id');
    }
    
}