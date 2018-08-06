<?php

namespace RefinedDigital\SocialMedia\Module\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use RefinedDigital\CMS\Modules\Core\Models\CoreModel;
use Spatie\EloquentSortable\Sortable;

class SocialMedia extends CoreModel implements Sortable
{
    use SoftDeletes;

    protected $fillable = [
        'active', 'position', 'name', 'icon', 'link',
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
                    [ 'label' => 'Icon', 'name' => 'icon', 'required' => true, 'note' => 'Icons are using <a href="https://www.fontawesome.com/icons" target="_blank">fontawesome.com</a> icon set.<br/> Find the icon you want to use, click on it and select the full <code>class</code> path, ie <code>fas fa-share-alt-square</code>'],
                    [ 'label' => 'Link', 'name' => 'link', 'required' => true],
                ]
            ]
        ]
    ];
}
