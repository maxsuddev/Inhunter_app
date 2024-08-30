<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    protected RoleInterface $roleRepository;
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = $this->roleRepository->all();

            $errorMessage = null;
            if(is_string($roles)) {
                $errorMessage = $roles;
            }
            return view('role.index', compact('roles', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday role topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('role.index')->with('error', 'No se han encontrado roles!');
        }
    }
}
