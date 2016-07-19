<?php

namespace Allison\Repositories\Contracts;

interface IfFbAdMediaRepository {
    
    public function getAllAdMedia();
    
    public function create($request, $fileName, $file_size, $admedia_helper);

    public function getAdMedia($id);

    public function update($request, $ad_admedia_helper, $id);

    public function destroy($ad_admedia_helper, $id);

        
}
