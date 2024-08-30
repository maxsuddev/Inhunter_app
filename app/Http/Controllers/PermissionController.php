<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionInterface;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    protected PermissionInterface $permissionRepository;
    public function __construct(PermissionInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        try {
            $permissions = $this->permissionRepository->all();

            $errorMessage = null;
            if(is_string($permissions)) {
                $errorMessage = $permissions;
            }
            return view('permission.index', compact('permissions', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday permission topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('permission.index')->with('error', 'No se han encontrado permissions!');
        }
    }
}
