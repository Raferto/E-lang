<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\KeluhanRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    private $repoKeluhan;

    public function __construct(KeluhanRepositoryInterface $repoKeluhan)
    {
        $this->repoKeluhan = $repoKeluhan;
    }

    public function showForm() {
        return view('keluhan.form-keluhan')->with('user_id', Auth::user()->id);
    }

    public function create(Request $request) {
        $keluhan = $this->repoKeluhan->create($request);

        $this->repoKeluhan->sendMailAck($keluhan);

        return redirect()->back();
    }
}
