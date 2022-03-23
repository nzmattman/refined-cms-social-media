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
            'sections' => [
                'left' => [
                    'blocks' => [
                        [
                            'name' => 'Content',
                            'fields' => [
                                [
                                    [ 'label' => 'Name', 'name' => 'name', 'required' => true],
                                    [ 'label' => 'Link', 'name' => 'link', 'required' => true],
                                ]
                            ]
                        ]
                    ]
                ],
                'right' => [
                    'blocks' => [
                        [
                            'name' => 'Settings',
                            'fields' => [
                                [
                                    [ 'label' => 'Active', 'name' => 'active', 'required' => true, 'type' => 'select', 'options' => [1 => 'Yes', 0 => 'No'] ],
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    protected $blockIcon = [
        'name' => 'Icon',
        'fields' => [
            [
                [ 'label' => 'SVG Icon', 'name' => 'icon', 'required' => true, 'type' => 'image', 'hideLabel' => true, 'note' => 'For best results, use an <code>svg</code> image'],
            ]
        ]
    ];

    public function setFormFields()
    {
        $config = config('social-media');
        $fields = $this->formFields;

        if (isset($config['hasIcons']) && $config['hasIcons']) {
            array_splice($fields[0]['sections']['right']['blocks'], 1, 0, [$this->blockIcon]);
        }

        return $fields;
    }
}
