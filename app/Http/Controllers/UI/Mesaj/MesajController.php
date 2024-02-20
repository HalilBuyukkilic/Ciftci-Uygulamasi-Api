<?php

namespace App\Http\Controllers\UI\Mesaj;

use App\Http\Controllers\Controller;
use App\Models\Mesajlar\Mesaj;
use App\Models\Mesajlar\Rooms;
use Illuminate\Http\Request;


class MesajController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $odalar = Rooms::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id)
                ->orWhere('client_id', $user_id);
        })->get();

        return response()->json(['data' => $odalar]);
    }

    public function getmessages(Request $request)
    {
        $room_id = $request->input('room_id');
        $messages = Mesaj::where('room_id', $room_id)->get();

        return response()->json(['data' => $messages]);
    }

    public function getMessageswithAdvert(Request $request)
    {
        $ilan_id = $request->input('ilan_id');
        $user_id = $request->input('user_id');
        $receiver_id = $request->input('receiver_id');
        $odalar = Rooms::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id)
                ->orWhere('client_id', $user_id);
        })
            ->where(function ($query) use ($receiver_id) {
                $query->where('user_id', $receiver_id)
                    ->orWhere('client_id', $receiver_id);
            })
            ->where('ilan_id', $ilan_id)
            ->pluck('room_id');

        $roomMessages = Mesaj::whereIn('room_id', $odalar)
            ->get();


        return response()->json(['data' => $roomMessages]);
    }

    public function updateSeensMessage(Request $request)
    {
        try {
            $id_array = $request->input('ids');
            foreach ($id_array as $message_id) {
                $message = Mesaj::find($message_id);
                if ($message) {
                    $message->isSeens = true;
                    $message->save();
                }
            }

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => $e . message]);
        }
    }
}
