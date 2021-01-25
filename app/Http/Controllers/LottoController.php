<?php

namespace App\Http\Controllers;

use App\User;
use App\Lotto;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LottoController extends Controller
{
    //
    public function lottoGame($id)
    {
        //抓到本人
        $user = User::find(auth()->user()->id);
        //我的點數
        $myPoint = User::find(auth()->user()->id)->point;
        //如果點數小於10，跳轉回頁面
        if ($myPoint < 10) {
            Log::alert('點數不足，努力存點！！');
            return redirect()->back();
            //反之扣10點，並且抽獎
        } else {
            //點數扣點
            User::find(auth()->user()->id)->update([
                'point' => $myPoint - 10,
            ]);

            //獎品組
            $prize = [
                '銘謝惠顧', '銘謝惠顧', '銘謝惠顧',
                '銘謝惠顧', '銘謝惠顧', '銘謝惠顧',
                '再接再厲', '再接再厲', '再接再厲',
                '再接再厲', '再接再厲', '再接再厲',
                '再接再厲', '銘謝惠顧', '再接再厲',
                '四獎-特休2分鐘',
                '四獎-特休2分鐘',
                '三獎-特休5分鐘',
                '三獎-特休5分鐘',
                '二獎-零食拿一包',
                '頭獎-主管請你喝飲料',
                '銘謝惠顧', '再接再厲', '銘謝惠顧',
                '再接再厲', '銘謝惠顧', '再接再厲',
                '銘謝惠顧', '再接再厲', '銘謝惠顧',
                '再接再厲', '銘謝惠顧', '再接再厲',
                '銘謝惠顧', '再接再厲', '銘謝惠顧',
                '銘謝惠顧', '再接再厲', '銘謝惠顧',
                '銘謝惠顧',
            ];
            //隨機抽選
            $random = Arr::random($prize);

            //創建得獎者資料
            Lotto::create([
                'user_id' => auth()->user()->id,
                'prize' => $random,
                'awarded' => $user->name,
            ]);


            return redirect()->to('/admin/lotto/index');
        };
    }

    public function lottoIndex()
    {

        //抓到本人
        $user = User::find(auth()->user()->id);

        //抓出自己得獎獎品
        $listOfAwards = Lotto::all()->where('awarded',$user->name);

        return view('admin.lotto.index',compact('listOfAwards','user'));
    }
}
