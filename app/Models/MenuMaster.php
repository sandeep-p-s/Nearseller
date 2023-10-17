<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MenuMaster extends Model
{
    use HasFactory;

    protected function UserPageMenu($userId)
    {
        $menuItems = DB::select(
            "
                SELECT a.id as menu_id, a.menu_desc, a.url, a.menu_level_1, a.menu_level_2, a.menu_level_3
                FROM menu_masters a
                LEFT JOIN user_pages b ON a.id = b.menu_id
                WHERE a.status = 1 AND b.user_id = ?
                ORDER BY menu_level_1, menu_level_2, menu_level_3
            ",
            [$userId],
        );
        $structuredMenu = [];
        foreach ($menuItems as $row) {
            $m1 = $row->menu_level_1;
            $m2 = $row->menu_level_2;
            $m3 = $row->menu_level_3;
            $url = $row->url;
            if (!isset($structuredMenu[$m1])) {
                $structuredMenu[$m1] = [];
            }
            if (!isset($structuredMenu[$m1][$m2])) {
                $structuredMenu[$m1][$m2] = [];
            }
            $structuredMenu[$m1][$m2][$m3] = [$row->menu_desc, $url];
        }
        return $structuredMenu;
    }

    protected function AllSecrtorDetails($userId,$roleid)
    {
        $roleIdsArray = explode(',', $roleid);
        if (in_array('1', $roleIdsArray)) {
            $allsectdetails = '';
        } elseif (in_array('2', $roleIdsArray)) {
            $allsectdetails = DB::table('seller_details')
                ->where('user_id', $userId)
                ->first();
        } elseif (in_array('9', $roleIdsArray)) {
            $allsectdetails = DB::table('seller_details')
                ->where('user_id', $userId)
                ->first();
        } else {
            $allsectdetails = DB::table('user_account')
                ->where('id', $userId)
                ->first();
        }
        return $allsectdetails;
    }
}
