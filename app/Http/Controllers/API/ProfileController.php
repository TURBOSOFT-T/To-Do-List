<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends BaseController
{
    /** Get data profile user */
    public function get_data($id)
    {
        $data = User::where('id', $id)->get();
        if (User::where('id', $id)->doesntExist()) {
            return $this->sendError('User not found.');
        } else {
            return $this->getResponse($data, 'Data user.');
        }
    }

    /** Store change data profile user */
    public function change_data($id)
    {
        
        
    }
}
