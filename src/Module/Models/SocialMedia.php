<?php

namespace RefinedDigital\SocialMedia\Module\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use RefinedDigital\CMS\Modules\Core\Models\CoreModel;
use Spatie\EloquentSortable\Sortable;

class SocialMedia extends CoreModel implements Sortable
{
    use SoftDeletes;

    protected $fillable = [
        'active', 'position', 'name', 'svg_icon', 'link',
    ];

    protected $table = 'social_media';

    /**
     * The fields to be displayed for creating / editing
     *
     * @var array
     */
    public $formFields = [
        [
            'name' => 'Content',
            'fields' => [
                [
                    [ 'label' => 'Active', 'name' => 'active', 'required' => true, 'type' => 'select', 'options' => [1 => 'Yes', 0 => 'No'] ],
                ],
                [
                    [ 'label' => 'Name', 'name' => 'name', 'required' => true],
                    [ 'label' => 'Link', 'name' => 'link', 'required' => true],
                ],
                [
                    [ 'label' => 'SVG Icon', 'name' => 'svg_icon', 'required' => true, 'type' => 'textarea'],
                ]
            ]
        ]
    ];
}
