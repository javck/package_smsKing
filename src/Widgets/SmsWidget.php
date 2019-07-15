<?php

namespace Javck\SmsKing\Widgets;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use Auth;

class SmsWidget extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $points = app('smsking')->searchPointsUrl();
        //$string = trans_choice('voyager::dimmer.user', $count);
        $string = '點';
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-logbook',
            'title'  => "{$points} {$string}",
            'text'   => "剩餘簡訊點數:" . $points,
            'button' => [
                'text' => '更多資訊',
                'link' => 'https://www.kotsms.com.tw/index.php'
            ],
            'image' => url('storage/images/widgets/sms.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
