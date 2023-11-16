<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;

class ManActionParticipant extends Controller
{
    public function create(){
        return view('action-participant.index');
    }
}
