<?php

namespace VCComponent\Laravel\Category\Traits;

trait CategoryQueryTrait
{
    /**
     * Scope a query to only include categories of a given type.
     * 
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include hot categories.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsHot($query)
    {
        return $query->where('is_hot', 1);
    }

    /**
     * Scope a query to only include published categories.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPublished($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to order categories by order column.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortByOrder($query, $order = 'acs')
    {
        return $query->orderBy('order', $order);
    }

    /**
     * Scope a query to order categories by name column.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortByName($query, $order = 'asc')
    {
        return $query->orderBy('name', $order);
    }

    /**
     * Scope a query to order categories by usage time. From hight to low.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMostUsed($query, $categoryable_type = null)
    {
        return $query->withCount(['categoryables' => function ($q) use ($categoryable_type) {
            if ($categoryable_type) {
                $q->where('categoryable_type', $categoryable_type);
            }
        }])->orderBy('categoryables_count', 'desc');
    }

    /**
     * Scope a query to order categories by usage time. From low to hight.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $order
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLeastUsed($query, $categoryable_type = null)
    {
        return $query->withCount(['categoryables' => function ($q) use ($categoryable_type) {
            if ($categoryable_type) {
                $q->where('categoryable_type', $categoryable_type);
            }
        }])->orderBy('categoryables_count', 'asc');
    }
}
