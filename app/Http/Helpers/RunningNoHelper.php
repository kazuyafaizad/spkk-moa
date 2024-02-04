<?php

namespace App\Http\Helpers;

use App\Models\Branch;
use App\Models\ComplaintRunner;
use App\Models\User;

class RunningNoHelper
{
    // //Running untuk kesalahan
    // public static function generateOffenceNo($userId, $offenceId)
    // {
    //     $offenceNo = '';
    //     $user = User::find($userId);

    //     $branch = Branch::find($user->branch_id);

    //     if ($branch) {
    //         //NP
    //         if ($offenceId == 3) {
    //             $offenceNo = 'NP/' . date('Y') . '/' . date('m') . '/' . $branch->branch_file_code . '/' . $branch->np;
    //             $branch->np = $branch->np + 1;
    //             $branch->save();

    //             return $offenceNo;

    //             //NPK
    //         } elseif ($offenceId == 4) {
    //             //NPK/2023/bulan/branch_id/running no

    //             $offenceNo = 'NPK/' . date('Y') . '/' . date('m') . '/' . $branch->branch_file_code . '/' . $branch->npk;
    //             $branch->npk = $branch->npk + 1;
    //             $branch->save();

    //             return $offenceNo;
    //         }
    //     }

    //     return $offenceNo;
    // }

    // //Running untuk LAK
    // public static function generateLak($userId)
    // {
    //     $lak = '';

    //     $user = User::find($userId);

    //     $branch = Branch::find($user->branch_id);

    //     if ($branch) {
    //         $lak = $branch->branch_file_code . '.600-2/5/7/' . $branch->lak;

    //         $branch->lak = $branch->lak + 1;
    //         $branch->save();
    //     }

    //     return $lak;
    // }

    // //Running untuk Sita
    // public static function generateSita($userId)
    // {
    //     $sita = '';

    //     $user = User::find($userId);

    //     $branch = Branch::find($user->branch_id);

    //     if ($branch) {
    //         $sita = $branch->branch_file_code . '.600-2/5/6/' . $branch->sita;

    //         $branch->sita = $branch->sita + 1;
    //         $branch->save();
    //     }

    //     return $sita;
    // }

    // //Running untuk Aduan
    // public static function generateAduan($userId)
    // {
    //     $complaint = '';

    //     $user = User::find($userId);

    //     $branch = Branch::find($user->branch_id);

    //     if ($branch) {
    //         $complaint = $branch->branch_file_code . '.100-9/3/8/' . $branch->complaint;

    //         $branch->complaint = $branch->complaint + 1;
    //         $branch->save();
    //     }

    //     return $complaint;
    // }

    public static function generatePublicComplaintReference($type, $year, $month)
    {
        $running = '';

        $current = ComplaintRunner::where('rule_1', $type)->first();

        if ($type != 'X') {
            $running = 'MOA/'.$type.str_pad($current->runner, 4, '0', STR_PAD_LEFT).'/'.$month.'/'.$year;
            $current->runner = $current->runner + 1;
            $current->save();
        } else {
            $running = 'MOA/X'.str_pad($current->runner, 4, '0', STR_PAD_LEFT).'/'.$month.'/'.$year;
            $current->runner = $current->runner + 1;
            $current->save();
        }

        return $running;
    }
}
