<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\KeluhanRepositoryInterface;

class KeluhanController extends Controller
{
    private $repoKeluhan;

    public function __construct(KeluhanRepositoryInterface $repoKeluhan)
    {
        $this->repoKeluhan = $repoKeluhan;
    }

    public function showForm() {
        $this->repoKeluhan->showForm();
    }

    public function create(Request $request) {
        $this->repoKeluhan->create($request);
    }
}
