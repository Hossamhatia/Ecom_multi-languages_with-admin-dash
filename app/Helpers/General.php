<?php


use Illuminate\Support\Facades\Config;

function get_languages()
{
    return \App\Models\Language::Active()->Selection()->get();
}

function get_default_language()
{
    return Config::get('app.locale');
}
function uploadImage($Folder,$image)
{
    $image->store('/',$Folder);
    $fileName = $image->hashName();
    $path = 'images/'.$Folder.'/'.$fileName;
    return $path;

}

