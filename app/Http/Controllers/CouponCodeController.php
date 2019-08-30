<?php

namespace App\Http\Controllers;

use App\CouponCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponCodeController extends Controller
{
    public function show(Request $request, $code)
    {
        // 优惠券是否存在
        if(!$record = CouponCode::query()->where('code',$code)->first()){
            abort(404);
        }
        $record->checkAvailable($request->user());

        return $record;
    }

}
