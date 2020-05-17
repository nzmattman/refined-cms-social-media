<?php

namespace RefinedDigital\SocialMedia\Module\Http\Controllers;

use RefinedDigital\CMS\Modules\Core\Http\Controllers\CoreController;
use RefinedDigital\SocialMedia\Module\Http\Requests\SocialMediaRequest;
use RefinedDigital\SocialMedia\Module\Http\Repositories\SocialMediaRepository;
use RefinedDigital\CMS\Modules\Core\Http\Repositories\CoreRepository;

class SocialMediaController extends CoreController
{
    protected $model = 'RefinedDigital\SocialMedia\Module\Models\SocialMedia';
    protected $prefix = 'socialMedia::';
    protected $route = 'social-media';
    protected $heading = 'Social Media';
    protected $button = 'a Link';

    protected $socialMediaRepository;

    public function __construct(CoreRepository $coreRepository)
    {
        $this->socialMediaRepository = new CoreRepository();
        $this->socialMediaRepository->setModel($this->model);

        parent::__construct($coreRepository);
    }

    public function setup()
    {

        $table = new \stdClass();
        $table->fields = [
            (object) [ 'name' => 'Name', 'field' => 'name', 'sortable' => true],
            (object) [ 'name' => 'Icon', 'field' => 'svg_icon', 'sortable' => true, 'type' => 'svg-icon'],
            (object) [ 'name' => 'Active', 'field' => 'active', 'type'=> 'select', 'options' => [1 => 'Yes', 0 => 'No'], 'sortable' => true, 'classes' => ['data-table__cell--active']],
        ];
        $table->routes = (object) [
            'edit'      => 'refined.social-media.edit',
            'destroy'   => 'refined.social-media.destroy'
        ];
        $table->sortable = true;

        $this->table = $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($item)
    {
        // get the instance
        $data = $this->model::findOrFail($item);

        return parent::edit($data);
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaRequest $request)
    {
        return parent::storeRecord($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaRequest $request, $id)
    {
        return parent::updateRecord($request, $id);
    }

}
