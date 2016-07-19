<?php

namespace Allison\Repositories\Contracts;

interface IfFbAdProductsRepository{

    public function getAllProducts();

    public function create($request);

    public function getProduct($id);

    public function update($request, $id);

    public function destroy($id);


}
