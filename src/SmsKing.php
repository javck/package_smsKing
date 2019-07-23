<?php
/**
 * Created by PhpStorm.
 * User: Zack
 * Date: 2019/7/12
 * Time: 上午 1:31
 */

namespace Javck\SmsKing;

class SmsKing
{

	public function __construct()
	{

	}

	    /*
	*	簡訊王寄出簡訊
	*	$smbody 簡訊內容
	*	$mobile 傳送的電話號碼
	*/
	public function sendSMS($smbody,$mobile) {
		$smgUrl = 'https://api.kotsms.com.tw/kotsmsapi-1.php?username='.config('smsking.SmgUsername').'&dstaddr='.$mobile.'&smbody='.mb_convert_encoding($smbody,"BIG5");
		if(config('smsking.SmgKey') != null){
			$smgUrl = $smgUrl .'&apikey='.config('smsking.SmgKey');
		}else if(config('smsking.SmgPassword') != null){
			$smgUrl = $smgUrl .'&password='.config('smsking.SmgPassword');
		}
		$smgStatusCode = explode("=",file_get_contents($smgUrl));
		return $smgStatusCode[1];	
	}

	/*
	*	簡訊王錯誤對應號碼
	* 	$smgStatusCode 簡訊王回傳的代碼，流水號
	*/
	public function smgTransStatusCode ($smgStatusCode) {
		switch ($smgStatusCode) {
			case -1:
				return "CGI string error ，系統維護中或其他錯誤 ,帶入的參數異常,伺服器異常";  
			case -2:
				return "授權錯誤(帳號/密碼錯誤)";
			case -4:
				return "A Number違反規則 發送端 870短碼VCSN 設定異常";
			case -5:
				return "B Number違反規則 接收端 門號錯誤 -";
			case -6:
				return "Closed User 接收端的門號停話異常090 094 099 付費代號等";
			case -20:
				return "Schedule Time錯誤 預約時間錯誤 或時間已過";
			case -21:
				return "Valid Time錯誤 有效時間錯誤";
			case -1000:
				return "發送內容違反NCC規範";
			case -59999:
				return "帳務系統異常 簡訊無法扣款送出";
			case -60002:
				return "您帳戶中的點數不足";
			case -60014:
				return "該用戶已申請 拒收簡訊平台之簡訊 ( 2010 NCC新規)";
			case -999949999:
				return "境外IP限制(只接受台灣IP發送，欲申請過濾請洽簡訊王客服)";
			case -999959999:
				return "在12 小時內，相同容錯機制碼";
			case -999969999:
				return "同秒, 同門號, 同內容簡訊";
			case -999979999:
				return "鎖定來源IP";
			case -999989999: 
				return "簡訊為空";
			default:
				return $smgStatusCode;
		}

	}


	/*
	*	簡訊王查詢發送的結果
	*	$kmsgid 傳送簡訊時的紀錄編號
	*
	*/
	public function searchSmgStatusUrl($kmsgid) {
		$smgStatusUrl = 'https://api.kotsms.com.tw/msgstatus.php?username='.env('SMG_USERNAME','null').'&apikey='.env('SMG_APIKEY','null').'&kmsgid='.$kmsgid;
		$searchCode = explode("=",file_get_contents($smgStatusUrl));
		return $searchCode[1];
	}

	/*
	*	簡訊王查詢剩餘點數
	*	
	*/	

	public function searchPointsUrl() {
		$getpointsUrl = 'https://api.kotsms.com.tw/memberpoint.php?username='.config('smsking.SmgUsername');
		if(config('smsking.SmgKey') != null){
			$getpointsUrl = $getpointsUrl .'&apikey='.config('smsking.SmgKey');
		}else if(config('smsking.SmgPassword') != null){
			$getpointsUrl = $getpointsUrl .'&password='.config('smsking.SmgPassword');
		}
		$pointsNumber = file_get_contents($getpointsUrl);
		return $pointsNumber;
	}



}