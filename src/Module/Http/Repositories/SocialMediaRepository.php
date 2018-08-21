<?php

namespace RefinedDigital\SocialMedia\Module\Http\Repositories;


use RefinedDigital\CMS\Modules\Core\Http\Repositories\CoreRepository;
use RefinedDigital\SocialMedia\Module\Models\SocialMedia;

class SocialMediaRepository
{
    public function getForFront()
    {
        $repo = new CoreRepository();
        $repo->setModel('RefinedDigital\SocialMedia\Module\Models\SocialMedia');
        return $repo->getForFront();
    }

    public function getByIds($ids = [])
    {
        if (sizeof($ids)) {
            return SocialMedia::whereIn('id', $ids)->whereActive(1)->orderBy('position', 'asc')->get();
        }

        return null;
    }

    public function find($id = false)
    {
        if ($id) {
            return SocialMedia::whereId($id)->whereActive(1)->first();
        }

        return null;
    }
}
