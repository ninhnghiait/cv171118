<?php

namespace App\Http\Middleware\Aboutme;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AbmAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $objUser = Auth::user();
        $uid = $objUser->id;
        $username = $objUser->username;
        $fullname = $objUser->fullname;

        //lấy các group của user
        $objGroups = DB::table('users_groups as ug')
            ->join('groups as g', 'ug.gId', '=', 'g.id_group')
            ->where('ug.uId', $uid)
            ->get();

        $isRole = false;
        $arRole = explode('|', $role);

        foreach ($objGroups as $key => $objGroup) {
            $gid = $objGroup->id_group;
            $gcode = $objGroup->code;
            $gname = $objGroup->name;

            if (in_array($gcode, $arRole)) {
                $isRole = true; break;
            }
        }
        if (!$isRole) {
            return redirect()->route('admin.adindex.index');
        }

        return $next($request);
    }
}
