<?php

namespace App\Functions;

use App\Mail\{
    Reset as ResetMail,
    Plain as PlainMail,
    Reserve as ReserveMail,
};
use Illuminate\Support\{
    Facades\Mail as Mailer,
    Facades\DB as DB,
    Str,
};
use App\Models\User;


class Mail
{
    public const FORGOT = "FORGOT";

    public static function reset($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $token = Str::random(20);

        $row = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if (!$row) {
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
            ]);
        } else {
            DB::table('password_reset_tokens')->where('email', $user->email)->update([
                'token' => $token,
            ]);
        }

        $mail = new ResetMail(['to' => [$user->email], 'token' => $token]);
        Mailer::send($mail);

        return true;
    }

    public static function plain($data)
    {
        $mail = new PlainMail($data);
        Mailer::send($mail);
    }

    public static function reserve($data)
    {
        $mail = new ReserveMail($data);
        Mailer::send($mail);
    }
}
