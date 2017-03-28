<?php

interface BannersRepositoryInterface
{

    public function lists($data);

    public function create($data);

    public function update($data);
    
    public function destroy($data);
}
