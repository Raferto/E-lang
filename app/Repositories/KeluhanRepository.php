<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Keluhan;
use App\Models\User;

class KeluhanRepository implements KeluhanRepositoryInterface {

    public function create(Request $request) {

        $validated = $request->validate([
            'user_id' => 'required',
            'subjek' => 'required',
            'isi' => 'required'
        ]);

        $keluhan = Keluhan::create([
            'user_id' => $validated['user_id'],
            'subjek' => $validated['subjek'],
            'isi_keluhan' => $validated['isi']
        ]);

        return $keluhan;
    }

    public function sendMailAck($keluhan) {

        // kirim notif ke user
        $user = Auth::user();

        \Mail::to($user->email)->send(new \App\Mail\KeluhanAcknowledgementMail($user, $keluhan, 'user'));

        // kirim keluhan ke admin

        \Mail::to(env('MAIL_ADMIN'))->send(new \App\Mail\KeluhanAcknowledgementMail($user, $keluhan, 'admin'));
    }
}
