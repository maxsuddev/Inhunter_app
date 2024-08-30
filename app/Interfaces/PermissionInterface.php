<?php

namespace App\Interfaces;

interface PermissionInterface
{
    public function getPermissions();


    public function addPermission( array$request);


    public function deletePermission(int$id);


    public function updatePermission(array$request, int$id);
}
