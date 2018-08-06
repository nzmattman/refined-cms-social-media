<?php

namespace RefinedDigital\SocialMedia\Module\Http\Repositories;

use RefinedDigital\CMS\Modules\Core\Http\Repositories\CoreRepository;

class SocialMediaRepository extends CoreRepository
{

    public function __construct()
    {
        $this->setModel('RefinedDigital\SocialMedia\Module\Models\SocialMedia');
    }
}
