<?php

Route::namespace('SocialMedia\Module\Http\Controllers')
    ->group(function() {
        Route::resource('social-media', 'SocialMediaController');
    })
;