<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function ccc( $var ) {
		$this->show( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器lll ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
		dump( $var );

	}

public function check_login_status()
	{
		if(!(session("?uid")) && !(cookie('uid')))
		//if(!isset($_SESSION['USER_AUTH_KEY'])||($_SESSION['USER_AUTH_KEY']==0))//不能用此句
		{
			return false;
		}
		else
		{
			return true;
		}
	    
	}

	public function get_yan_zheng_ma($num){

		if(!(session("?yan_zheng_ma"))){
			$yan_zheng_ma = rand(100000,200000);
			session('yan_zheng_ma',$yan_zheng_ma);
		}

		//if(!(session("?uid")));
		echo "$yan_zheng_ma";
		$smsclient = new SMSClient();
		$sent_ret = $smsclient->sendSMS($num, session('yan_zheng_ma'));

		$tmp['return_code'] = "success";
		$this->ajaxReturn($tmp,'JSON');

	}

	public function get_all_items($method_name, $start, $length) {
		//FIXME
		if($method_name=='abc')
			if(!$this->check_login_status()){
				$tmp['return_code'] = "error";
				$this->ajaxReturn($tmp,'JSON');
		}

		switch ($method_name) {

			case 'wen_da':
				$new=D( $method_name );

				$result['da_yi']=$new->where( 'lei_mu="da_yi"' )->select();
				$result['jian_ce']=$new->where( 'lei_mu="jian_ce"' )->select();
				$result['ping_gu']=$new->where( 'lei_mu="ping_gu"')->select();
				$result['bao_yang']=$new->where( 'lei_mu="bao_yang"')->select();

				$result_array['data']=$result;

				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');

				break;

			case 'chang_jian_wen_ti':
				$new=D( $method_name );

				$result['bao_yang']=$new->where( 'wen_ti_lei_xing="bao_yang"' )->select();
				$result['yan_bao']=$new->where( 'wen_ti_lei_xing="yan_bao"' )->select();

				$result_array['data']=$result;

				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');

				break;

			case 'jian_che_bao_gao':
				$new=D( $method_name );

				//$result['1']=$new->where( 'SHOW COLUMNS FROM "jian_che_bao_gao"' )->select();
				$result=$new->where( 'bao_gao_bian_hao="6666"')->limit(0,1)->select();
		//		$s['a']=1;
		//		$s['b']=2;
		//		dump($s);
		//		dump($s['a']);


			//	for(int i=0; i<100; i++)
//车辆展示图片
					for($j=1; $j<9; $j++)
					{
					//	echo "'$j'_1";
							$name = 'zhan_shi_tu_pian_';
							$name .= $j;

							if(array_key_exists($name, $result[0])){
								$zhan_shi_tu_pian[$j] = $result[0][$name];
       						} else {
       							break;
       						}
					}
				
				$final_result['zhan_shi_tu_pian'] = array_values($zhan_shi_tu_pian);
//车辆交易信息检查
//echo "che-liang-jiao-yi-xin-xi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '1_';
							$name .= $j;
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$cljyxx[$j] = '1';
								}
								else{
									$cljyxx[$j] = '0';
								}
       						} else {
       							break;
       						}
					}

					$final_result['cljyxx'] = array_values($cljyxx);
			//		dump($cljyxx);

//车身外观检查
//echo "che-shen-wai-guan-jian-cha";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '2_';
							$name .= $j;
							$name .= '_1';


							if(array_key_exists($name, $result[0])){
								$cswgjc[$j] = $result[0][$name];
       						} else {
       							break;
       						}
					}




					$cswgjc_tu_pian['fdjg'] = $result[0]['2_1_4'];
					$cswgjc_tu_pian['qyzb_l'] = $result[0]['2_2_4'];
					$cswgjc_tu_pian['hyzb_l'] = $result[0]['2_3_4'];
					$cswgjc_tu_pian['qyzb_r'] = $result[0]['2_4_4'];
					$cswgjc_tu_pian['hyzb_r'] = $result[0]['2_5_4'];
					$cswgjc_tu_pian['qm_l'] = $result[0]['2_6_4'];
					$cswgjc_tu_pian['hm_l'] = $result[0]['2_7_4'];
					$cswgjc_tu_pian['qm_r'] = $result[0]['2_8_4'];
					$cswgjc_tu_pian['hm_r'] = $result[0]['2_9_4'];
//					$cswgjc_tu_pian['xlxg'] = $result[0]['2_10_4'];
					$cswgjc_tu_pian['xlxg_i'] = $result[0]['2_11_4'];
					$cswgjc_tu_pian['cd'] = $result[0]['2_12_4'];
					$cswgjc_tu_pian['bxg_f'] = $result[0]['2_13_4'];
					$cswgjc_tu_pian['bxg_b'] = $result[0]['2_14_4'];
					$cswgjc_tu_pian['qlg_l'] = $result[0]['2_15_4'];
					$cswgjc_tu_pian['hlg_l'] = $result[0]['2_16_4'];
					$cswgjc_tu_pian['qlg_r'] = $result[0]['2_17_4'];
					$cswgjc_tu_pian['hlg_r'] = $result[0]['2_18_4'];
					$cswgjc_tu_pian['qlt_l'] = $result[0]['2_19_4'];
					$cswgjc_tu_pian['hlt_l'] = $result[0]['2_20_4'];
					$cswgjc_tu_pian['qlt_r'] = $result[0]['2_21_4'];
					$cswgjc_tu_pian['hlt_r'] = $result[0]['2_22_4'];

					$cswgjc_tu_pian['qdd_l'] = $result[0]['2_23_4'];
					$cswgjc_tu_pian['qdd_r'] = $result[0]['2_23_4'];

					$cswgjc_tu_pian['wd_l'] = $result[0]['2_24_4'];
					$cswgjc_tu_pian['wd_r'] = $result[0]['2_24_4'];

					$cswgjc_tu_pian['hwd_l'] = $result[0]['2_25_4'];
					$cswgjc_tu_pian['hwd_r'] = $result[0]['2_25_4'];

					$cswgjc_tu_pian['scd'] = $result[0]['2_26_4'];

					$cswgjc_tu_pian['dfbl_f'] = $result[0]['2_27_4'];
					$cswgjc_tu_pian['tc'] = $result[0]['2_28_4'];
					$cswgjc_tu_pian['dfbl_b'] = $result[0]['2_29_4'];

					$cswgjc_tu_pian['ccbl_lf'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_rf'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_rb'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_lb'] = $result[0]['2_30_4'];

					$cswgjc_tu_pian['hsj_l'] = $result[0]['2_31_4'];
					$cswgjc_tu_pian['hsj_r'] = $result[0]['2_32_4'];

					$final_result['cswgjc_tu_pian'] = $cswgjc_tu_pian;

					$final_result['cswgjc'] = array_values($cswgjc);
				//	dump($cswgjc);

//发动机检查
//echo "fa-dong-ji-jian-cha";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '3_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "严重")){
									$fdjjc[$j] = '2';
								} else if ( $this->checkstr($result[0][$name], "轻微") ){
									$fdjjc[$j] = '1';
       							} else {
									$fdjjc[$j] = '0';
       							}
       						} else {
       							break;
       						}
       						
					}
//FIXME
					$final_result['fdjjc_que_xian_miao_shu'] = "";
					$final_result['fdjjc'] = array_values($fdjjc);
				//	dump($fdjjc);

//功能性检查
//echo "gong-neng-xing-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '4_';
							$name .= $j;
							$name .= '_1';

							$name_bei_zhu = '4_';
							$name_bei_zhu .= $j;
							$name_bei_zhu .= '_3';

							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "异常")){
									$gnxjc[$j] = '1';
									$gnxjc_bei_zhu[$j] =  $result[0][$name];
								} else {
									$gnxjc[$j] = '0';
									$gnxjc_bei_zhu[$j] =  $result[0][$name];
       							} 
       						} else {
       							break;
       						}
					}

					$final_result['gnxjc_bei_zhu'] = array_values($gnxjc_bei_zhu);
					$final_result['gnxjc'] = array_values($fdjjc);
				//	dump($gnxjc);
				//	dump($gnxjc_bei_zhu);

//驾驶舱检查
//echo "jia-shi-cang-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '5_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$jscjc[$j] = '1';
								} else {
									$jscjc[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}
//FIXME
					$final_result['jscjc'] = array_values($jscjc);
					$final_result['jscjc_que_xian_miao_shu'] = "";
			//		dump($jscjc);


//底盘检查
//echo "di-pan-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '6_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$dpjc[$j] = '1';
								} else {
									$dpjc[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['dpjc_que_xian_miao_shu'] = "";
					$final_result['dpjc'] = array_values($dpjc);
			//		dump($dpjc);


//事故车判定
//echo "shi-gu-che-pan-ding";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '7_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								$sgcpd[$j] = $result[0][$name];
       						} else {
       							break;
       						}
       						
					}


					$final_result['sgcpd'] = array_values($sgcpd);
			//		dump($sgcpd);


//启动测试
//echo "qi-dong-ce-shi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '8_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$qdcs[$j] = '1';
								} else {
									$qdcs[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['qdcs_que_xian_miao_shu'] = "";
					$final_result['qdcs'] = array_values($qdcs);
				//	dump($qdcs);


//路试测试
//echo "lu-shi-ce-shi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '9_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$lscs[$j] = '1';
								} else {
									$lscs[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['lscs_que_xian_miao_shu'] = "";
					$final_result['lscs'] = array_values($lscs);
				//	dump($lscs);

					$final_result['zheng_bei_jian_yi'] = "";
					$final_result['jian_ce_yuan'] = "";


				//	echo "------------------------------";

	//				$aaa = "不能用此句你妈妈";

	//							if($this->checkstr($aaa)){
		//							echo "xxxxxxxxxx";
		//						}
	//							else 
		//							echo "yyyyyyyyyyyy";

	//			$a="1_1";

	//			dump($result[0][$a]);

	//			dump($result);


	//			dump($result[0]['1_1']);
	//			$this->ajaxReturn($result,'JSON');
				$result_array['data']=$final_result;

				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');

			default:
				# code...
				break;
		}

		$new=D( $method_name );
		$result=$new->limit($start, $length)->select();
		dump($result);
		$result_array['data']=$result;
		$result_array['return_code'] = "success";
		$this->ajaxReturn($result_array,'JSON');
	}

	public function get_jian_che_bao_gao($bao_gao_bian_hao){
$new=D( "jian_che_bao_gao" );

//"yong_hu_id='%s'", $yong_hu_id)->find(); 

				//$result['1']=$new->where( 'SHOW COLUMNS FROM "jian_che_bao_gao"' )->select();
				$result=$new->where( "cljbxx_vin_ma='%s'", $bao_gao_bian_hao)->limit(0,1)->select();
				// echo '-------------------------------';

				// dump($result);

				// echo '---------------------------------';
		//		$s['a']=1;
		//		$s['b']=2;
		//		dump($s);
		//		dump($s['a']);



      // 'jian_ce_ri_qi' => string '20141129002' (length=11)
      // 'cljbxx_pin_pai' => string '鍒厠' (length=6)
      // 'cljbxx_che_xi' => string '鍚涜秺' (length=6)
      // 'cljbxx_che_xing' => string '' (length=0)
      // 'cljbxx_che_shen_yan_se' => string '榛�' (length=3)
      // 'cljbxx_pai_zhao_hao_ma' => string '浜琎U5C85' (length=9)
      // 'cljbxx_vin_ma' => string 'LSGGF53X8AH255277' (length=17)
      // 'cljbxx_fa_dong_ji_hao' => string '102160403' (length=9)
      // 'cljbxx_chu_ci_deng_ji_ri_qi' => string '2010骞�9鏈�28鏃�' (length=16)
      // 'cljbxx_biao_xian_li_cheng' => string '73253' (length=5)
      // 'cljbxx_chan_di' => string '鍥戒骇' (length=6)
      // 'cljbxx_huan_bao_biao_zhun' => string '鍥藉洓' (length=6)
      // 'clzp_che_jian_ping_fen' => string '' (length=0)
      // 'clzp_che_jian_ping_ji' => string '' (length=0)
   
$final_result['bao_gao_bian_hao'] = $result[0]['bao_gao_bian_hao'];
				$final_result['jian_ce_ri_qi'] = $result[0]['jian_ce_ri_qi'];
$final_result['cljbxx_pin_pai'] = $result[0]['cljbxx_pin_pai'];

$final_result['cljbxx_che_xi'] = $result[0]['cljbxx_che_xi'];
$final_result['cljbxx_che_xing'] = $result[0]['cljbxx_che_xing'];
$final_result['cljbxx_che_shen_yan_se'] = $result[0]['cljbxx_che_shen_yan_se'];
$final_result['cljbxx_pai_zhao_hao_ma'] = $result[0]['cljbxx_pai_zhao_hao_ma'];
$final_result['cljbxx_vin_ma'] = $result[0]['cljbxx_vin_ma'];
$final_result['cljbxx_fa_dong_ji_hao'] = $result[0]['cljbxx_fa_dong_ji_hao'];
$final_result['cljbxx_chu_ci_deng_ji_ri_qi'] = $result[0]['cljbxx_chu_ci_deng_ji_ri_qi'];
$final_result['cljbxx_biao_xian_li_cheng'] = $result[0]['cljbxx_biao_xian_li_cheng'];
$final_result['cljbxx_chan_di'] = $result[0]['cljbxx_chan_di'];
$final_result['cljbxx_huan_bao_biao_zhun'] = $result[0]['cljbxx_huan_bao_biao_zhun'];
$final_result['clzp_che_jian_ping_fen'] = $result[0]['clzp_che_jian_ping_fen'];
$final_result['clzp_che_jian_ping_ji'] = $result[0]['clzp_che_jian_ping_ji'];


			//	for(int i=0; i<100; i++)
//车辆展示图片
					for($j=1; $j<9; $j++)
					{
					//	echo "'$j'_1";
							$name = 'zhan_shi_tu_pian_';
							$name .= $j;

							if(array_key_exists($name, $result[0])){
								$zhan_shi_tu_pian[$j] = $result[0][$name];
       						} else {
       							break;
       						}
					}
				
				$final_result['zhan_shi_tu_pian'] = array_values($zhan_shi_tu_pian);

				// if(!$final_result['zhan_shi_tu_pian'])
				// 	$final_result['zhan_shi_tu_pian'] = new array();

//车辆交易信息检查
//echo "che-liang-jiao-yi-xin-xi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '1_';
							$name .= $j;
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$cljyxx[$j] = '1';
								}
								else{
									$cljyxx[$j] = '0';
								}
       						} else {
       							break;
       						}
					}

					$final_result['cljyxx'] = array_values($cljyxx);
			//		dump($cljyxx);

//车身外观检查
//echo "che-shen-wai-guan-jian-cha";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '2_';
							$name .= $j;
							$name .= '_1';


							if(array_key_exists($name, $result[0])){
								$cswgjc[$j] = $result[0][$name];
       						} else {
       							break;
       						}
					}




					$cswgjc_tu_pian['fdjg'] = $result[0]['2_1_4'];
					$cswgjc_tu_pian['qyzb_l'] = $result[0]['2_2_4'];
					$cswgjc_tu_pian['hyzb_l'] = $result[0]['2_3_4'];
					$cswgjc_tu_pian['qyzb_r'] = $result[0]['2_4_4'];
					$cswgjc_tu_pian['hyzb_r'] = $result[0]['2_5_4'];
					$cswgjc_tu_pian['qm_l'] = $result[0]['2_6_4'];
					$cswgjc_tu_pian['hm_l'] = $result[0]['2_7_4'];
					$cswgjc_tu_pian['qm_r'] = $result[0]['2_8_4'];
					$cswgjc_tu_pian['hm_r'] = $result[0]['2_9_4'];
//					$cswgjc_tu_pian['xlxg'] = $result[0]['2_10_4'];
					$cswgjc_tu_pian['xlxg_i'] = $result[0]['2_11_4'];
					$cswgjc_tu_pian['cd'] = $result[0]['2_12_4'];
					$cswgjc_tu_pian['bxg_f'] = $result[0]['2_13_4'];
					$cswgjc_tu_pian['bxg_b'] = $result[0]['2_14_4'];
					$cswgjc_tu_pian['qlg_l'] = $result[0]['2_15_4'];
					$cswgjc_tu_pian['hlg_l'] = $result[0]['2_16_4'];
					$cswgjc_tu_pian['qlg_r'] = $result[0]['2_17_4'];
					$cswgjc_tu_pian['hlg_r'] = $result[0]['2_18_4'];
					$cswgjc_tu_pian['qlt_l'] = $result[0]['2_19_4'];
					$cswgjc_tu_pian['hlt_l'] = $result[0]['2_20_4'];
					$cswgjc_tu_pian['qlt_r'] = $result[0]['2_21_4'];
					$cswgjc_tu_pian['hlt_r'] = $result[0]['2_22_4'];

					$cswgjc_tu_pian['qdd_l'] = $result[0]['2_23_4'];
					$cswgjc_tu_pian['qdd_r'] = $result[0]['2_23_4'];

					$cswgjc_tu_pian['wd_l'] = $result[0]['2_24_4'];
					$cswgjc_tu_pian['wd_r'] = $result[0]['2_24_4'];

					$cswgjc_tu_pian['hwd_l'] = $result[0]['2_25_4'];
					$cswgjc_tu_pian['hwd_r'] = $result[0]['2_25_4'];

					$cswgjc_tu_pian['scd'] = $result[0]['2_26_4'];

					$cswgjc_tu_pian['dfbl_f'] = $result[0]['2_27_4'];
					$cswgjc_tu_pian['tc'] = $result[0]['2_28_4'];
					$cswgjc_tu_pian['dfbl_b'] = $result[0]['2_29_4'];

					$cswgjc_tu_pian['ccbl_lf'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_rf'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_rb'] = $result[0]['2_30_4'];
					$cswgjc_tu_pian['ccbl_lb'] = $result[0]['2_30_4'];

					$cswgjc_tu_pian['hsj_l'] = $result[0]['2_31_4'];
					$cswgjc_tu_pian['hsj_r'] = $result[0]['2_32_4'];

					$final_result['cswgjc_tu_pian'] = $cswgjc_tu_pian;

					$final_result['cswgjc'] = array_values($cswgjc);
				//	dump($cswgjc);

//发动机检查
//echo "fa-dong-ji-jian-cha";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '3_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "严重")){
									$fdjjc[$j] = '2';
								} else if ( $this->checkstr($result[0][$name], "轻微") ){
									$fdjjc[$j] = '1';
       							} else {
									$fdjjc[$j] = '0';
       							}
       						} else {
       							break;
       						}
       						
					}
//FIXME
					$final_result['fdjjc_que_xian_miao_shu'] = "";
					$final_result['fdjjc'] = array_values($fdjjc);
				//	dump($fdjjc);

//功能性检查
//echo "gong-neng-xing-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '4_';
							$name .= $j;
							$name .= '_1';

							$name_bei_zhu = '4_';
							$name_bei_zhu .= $j;
							$name_bei_zhu .= '_3';

							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "异常")){
									$gnxjc[$j] = '1';
									$gnxjc_bei_zhu[$j] =  $result[0][$name];
								} else {
									$gnxjc[$j] = '0';
									$gnxjc_bei_zhu[$j] =  $result[0][$name];
       							} 
       						} else {
       							break;
       						}
					}

					$final_result['gnxjc_bei_zhu'] = array_values($gnxjc_bei_zhu);
					$final_result['gnxjc'] = array_values($fdjjc);
				//	dump($gnxjc);
				//	dump($gnxjc_bei_zhu);

//驾驶舱检查
//echo "jia-shi-cang-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '5_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$jscjc[$j] = '1';
								} else {
									$jscjc[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}
//FIXME
					$final_result['jscjc'] = array_values($jscjc);
					$final_result['jscjc_que_xian_miao_shu'] = "";
			//		dump($jscjc);


//底盘检查
//echo "di-pan-jian-cha";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '6_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$dpjc[$j] = '1';
								} else {
									$dpjc[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['dpjc_que_xian_miao_shu'] = "";
					$final_result['dpjc'] = array_values($dpjc);
			//		dump($dpjc);


//事故车判定
//echo "shi-gu-che-pan-ding";

					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '7_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								$sgcpd[$j] = $result[0][$name];
       						} else {
       							break;
       						}
       						
					}


					$final_result['sgcpd'] = array_values($sgcpd);
			//		dump($sgcpd);


//启动测试
//echo "qi-dong-ce-shi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '8_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$qdcs[$j] = '1';
								} else {
									$qdcs[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['qdcs_que_xian_miao_shu'] = "";
					$final_result['qdcs'] = array_values($qdcs);
				//	dump($qdcs);


//路试测试
//echo "lu-shi-ce-shi";
					for($j=1; $j<100; $j++)
					{
					//	echo "'$j'_1";
							$name = '9_';
							$name .= $j;
							$name .= '_1';
							if(array_key_exists($name, $result[0])){
								if($this->checkstr($result[0][$name], "否")){
									$lscs[$j] = '1';
								} else {
									$lscs[$j] = '0';
       							} 
       						} else {
       							break;
       						}
       						
					}

					$final_result['lscs_que_xian_miao_shu'] = "";
					$final_result['lscs'] = array_values($lscs);
				//	dump($lscs);

					$final_result['zheng_bei_jian_yi'] = "";
					$final_result['jian_ce_yuan'] = "";


				//	echo "------------------------------";

	//				$aaa = "不能用此句你妈妈";

	//							if($this->checkstr($aaa)){
		//							echo "xxxxxxxxxx";
		//						}
	//							else 
		//							echo "yyyyyyyyyyyy";

	//			$a="1_1";

	//			dump($result[0][$a]);

	//			dump($result);


	//			dump($result[0]['1_1']);
	//			$this->ajaxReturn($result,'JSON');
				$result_array['data']=$final_result;

				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');


	}

	public function get_item($method_name, $query){
		$new=D( $method_name );
		$result=$new->where( $query )->select();
		dump($result);
		$result_array['data']=$result;
		$result_array['return_code'] = "success";
		$this->ajaxReturn($result_array,'JSON');
	}

	public function add_item_post_method(){

		$post = json_decode($GLOBALS['HTTP_RAW_POST_DATA'], true);

		$new=D( I('param.method_name') );

		switch ($post['method_name']) {
			case 'wen_da':
				$data['nei_rong'] = $post['nei_rong'];
				$data['jie_jue_zhuang_tai'] =  $post['jie_jue_zhuang_tai'];
				$data['lei_mu'] = $post['lei_mu']; 
				$data['yong_hu_id'] =  cookie('yong_hu_id');
				$data['biao_ti'] =  $post['biao_ti'];

				$wen_da = M('wen_da');
				$wen_da->add($data);
				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');
				break;

			case "yu_yue_ji_lu":

				$data['ding_dan_hao'] =  $post['ding_dan_hao'];

				$wen_da = M('wen_da');
				$wen_da->add($data);
				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');
				break;

			case "yong_hu":

				if(!(session("?yan_zheng_ma")) || session("?yan_zheng_ma") != I('post.yan_zheng_ma','','htmlspecialchars')){
					$result_array['return_code'] = "yan_zheng_ma_error";
					$this->ajaxReturn($result_array,'JSON');
				} else {

				$data['yong_hu_id'] = $post['yong_hu_id'];
				$data['yong_hu_ming'] = $post['yong_hu_ming'];

				$yong_hu = M('yong_hu');
				$yong_hu->add($data);

				session('yong_hu_id',$data['yong_hu_id']);
				cookie('yong_hu_id',$data['yong_hu_id']);

				$result_array['data']=$data;
				$result_array['return_code'] = "success";
				$this->ajaxReturn($result_array,'JSON');

				}
				break;
			default:
				$result_array['data']=null;
				$result_array['return_code'] = "11error";
				$this->ajaxReturn($result_array,'JSON');
				break;
		}


	}

	public function login(){
		$post = json_decode($GLOBALS['HTTP_RAW_POST_DATA'], true);

		if(!(session("?yan_zheng_ma")) || session("?yan_zheng_ma") != $post['yan_zheng_ma']){
			$result_array['return_code'] = "yan_zheng_ma_error";
			$this->ajaxReturn($result_array,'JSON');
			return;
		}

		 $data['yong_hu_id'] = $post['yong_hu_id'];

		 $new=M('yong_hu');

		 $yong_hu_id = $data['yong_hu_id'];

		// 把查询条件传入查询方法
		$result=$new->where("yong_hu_id='%s'", $yong_hu_id)->find(); 

		if($result){
			session('yong_hu_id',$data['yong_hu_id']);
			cookie('yong_hu_id',$data['yong_hu_id']);

			$result_array['data']=$result;
			$result_array['return_code'] = "success";
			$this->ajaxReturn($result_array,'JSON');
		}
		else {
			$result_array['data']=null;
			$result_array['return_code'] = "no_user_found_error";
			$this->ajaxReturn($result_array,'JSON');

		}
	}

	

	public function returnLoginStatus(){
		$data['status'] = 1;
		$data['info'] = 'info';
		$data['size'] = 9;
		$data['url'] = $url;
		$this->ajaxReturn($data,'JSON');
	}


	function checkstr($str, $needle){
		$tmparray = explode($needle,$str);
 		if(count($tmparray)>1){
 			return true;
 		} else{
 			return false;
	 }
	}









}


function xml2array($contents, $get_attributes=1) {
    if(!$contents) return array();

    if(!function_exists('xml_parser_create')) {
        return array();
    }
    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create();
    xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
    xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
    xml_parse_into_struct( $parser, $contents, $xml_values );
    xml_parser_free( $parser );

    if(!$xml_values) return;//Hmm...

    //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array;

    //Go through the tags.
    foreach($xml_values as $data) {
        unset($attributes,$value);//Remove existing values, or there will be trouble

        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.

        $result = '';
        if($get_attributes) {//The second argument of the function decides this.
            $result = array();
            if(isset($value)) $result['value'] = $value;

            //Set the attributes too.
            if(isset($attributes)) {
                foreach($attributes as $attr => $val) {
                    if($get_attributes == 1) $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                    /**  :TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
                }
            }
        } elseif(isset($value)) {
            $result = $value;
        }

        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;

            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                $current[$tag] = $result;
                $current = &$current[$tag];

            } else { //There was another element with the same tag name
                if(isset($current[$tag][0])) {
                    array_push($current[$tag], $result);
                } else {
                    $current[$tag] = array($current[$tag],$result);
                }
                $last = count($current[$tag]) - 1;
                $current = &$current[$tag][$last];
            }

        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;

            } else { //If taken, put all things inside a list(array)
                if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array...
                        or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
                    array_push($current[$tag],$result); // ...push the new element into that array.
                } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                }
            }

        } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
        }
    }

    return($xml_array);
}


class SMSClient {

	var $userId	= '963900';
	var $password	= 'dealche222010';
	var $account	= 'admin';

	//var $TokenId	= '36273ebc6f9c4cb783d80278aca8e48c';

	public function __construct($userId=null, $account=null, $password=null) {
		if ($userId) $this->userId = $userId;
		if ($password) $this->password = $password;
		if ($account) $this->account = $account;
	}

	function data_encode($data, $keyprefix = "", $keypostfix = "") {
	  assert( is_array($data) );
	  $vars=null;
	  foreach($data as $key=>$value) {
	    if(is_array($value)) $vars .= SMSClient::data_encode($value, $keyprefix.$key.$keypostfix.urlencode("["), urlencode("]"));
	    else $vars .= $keyprefix.$key.$keypostfix."=".urlencode($value)."&";
	  }
	  return $vars;
	}


	function _curl_post($url, $vars) {       

	    $ch = curl_init();    
	    curl_setopt($ch, CURLOPT_URL, $url);     
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//不向网页输出 
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_POST, 1);//POST请求
	    curl_setopt($ch, CURLOPT_POSTFIELDS, substr(SMSClient::data_encode($vars), 0, -1));//POST字段     
	    curl_setopt($ch, CURLOPT_VERBOSE, 1 );//启用时会汇报所有的信息     
	    $data = curl_exec($ch);
	    curl_close($ch);      
	    if ($data)
		return $data;     
	    else
		return false;     
	} 

	public function login() { 
		$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/UserLogin";
		$output = SMSClient::_curl_post($url, array('UserID'=>$this->userId, 'Account'=>$this->account, 'Password'=>$this->password));
		$data = xml2array($output);
		/*$fd = fopen('/tmp/sms.log', 'a');
		fwrite($fd, sprintf("[%s] %s\n", date('Y-m-d H:i:s'), serialize($data)));
		fclose($fd);*/

		if ($data) {
			$ret = $data['ROOT'];
			if ($ret['RetCode']['value'] == 'Sucess') {
				$info = array('SegmentUpperLimit'=> $ret['SegmentUpperLimit']['value'],
					'UserRight'=>$ret['UserRight']['value'],
					'LongSmsLen'=>$ret['LongSmsLen']['value'],
					'Token'=>$ret['Token']['value'],
					'SmsStock'=>$ret['SmsStock']['value'],
					'FetchSendStat'=>$ret['FetchSendStat']['value']
				);
				$this->TokenId = $info['Token'];
				return array('errorno'=>0, 'info'=>$info);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}
		} 
		return array('errorno'=>-1, 'info'=>'发送登陆请求失败');
	}

	public function getStockDetails() {
		$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/GetStockDetails";
		$output = SMSClient::_curl_post($url, array('Token'=>$token?$token:$this->TokenId));
		$data = xml2array($output);
		if ($data) {
			$ret = $data['ROOT'];
			if ($ret['RetCode']['value'] == 'Sucess') {
				$info = array('stockRemain'=>$ret['StockRemain']['value'],
					'points'=>$ret['Points']['value'],
					'sendTotal'=>$ret['SendTotal']['value'],
					'curDaySend'=>$ret['CurDaySend']['value']);

				return array('errorno'=>0, 'info'=>$info);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}

		} 
		return array('errorno'=>-2, 'info'=>'发送请求失败');

	}

	public function logout($token=null) {
		$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/UserLogOff";
		$output = SMSClient::_curl_post($url, array('Token'=>$token?$token:$this->TokenId));

		$data = xml2array($output);
		if ($data) {
			$ret = $data['ROOT'];
			if ($ret['RetCode']['value'] == 'Sucess') {
				return array('errorno'=>0);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}
		}
		return array('errorno'=>-1, 'info'=>'发送注销请求失败');
	}

	public function sendSMS($phones, $content, $postFixNumber=1, $sendTime='', $sendType=1) {
		echo "-----------------";
		echo "$phones";
		echo "-----------------";
		/*if ($this->TokenId) {
			$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/MessSendSMS";
			$param = array('Token'=>$this->TokenId, 'Phones'=>$phones, 'Content'=>$content, 'SendTime'=>$sendTime, 'SendType'=>$sendType, 'PostFixNumber'=>$postFixNumber);
		} else {*/
			$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/DirectSend";
			$param = array('UserID'=>$this->userId, 'Account'=>$this->account, 'Password'=>$this->password,
				'Phones'=>$phones, 'Content'=>$content, 'SendTime'=>$sendTime, 'SendType'=>$sendType, 'PostFixNumber'=>$postFixNumber);
		//}
		/*echo "sendSMS $phones, $content, $sendTime\n";
		print_r($param);
		return array('errorno'=>0, 'info'=>array('jobid'=>10));*/
		$output = SMSClient::_curl_post($url, $param);

		$data = xml2array($output);
		//print_r($data);
		if ($data) {
			$ret = $data['ROOT'];
			$info = array('jobid'=>$ret['JobID']['value']
				);

			if ($ret['RetCode']['value'] == 'Sucess') {
				return array('errorno'=>0, 'info'=>$info);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}
		}
		return array('errorno'=>-1, 'info'=>'发送短信请求失败');
	}

	public function fetchSMS() {
		/*$ret = array('errorno'=>0, 
			'info'=>array(
				'count'=>2,
				'smsgroup'=>array(
					'SMSGroup'=>array('value'=>'你们好啊','attr'=>array('Phone'=>'13810163123', 'RecDateTime'=>'2008-9-24 10:32')),
						array('value'=>'你也好啊','attr'=>array('Phone'=>'13810163123', 'RecDateTime'=>'2008-9-24 10:32'))
				)
			)
		);
		return $ret;*/

		if ($this->TokenId) {
			$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/FetchSMS";
			$param = array('Token'=>$this->TokenId);

		} else {
			$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/DirectFetchSMS";
			$param = array('UserID'=>$this->userId, 'Account'=>$this->account, 'Password'=>$this->password);
		}
		$output = SMSClient::_curl_post($url, $param);
		$data = xml2array($output);
		//print_r($data);
		/*$fd = fopen('/tmp/sms.log', 'a');
		fwrite($fd, sprintf("[%s] %s\n", date('Y-m-d H:i:s'), serialize($data)));
		fclose($fd);*/

		if ($data) {
			$ret = $data['ROOT'];
			if ($ret['RetCode']['value'] == 'Sucess') {
				if ($ret['Count']['value']) {
					$first_key = array_pop(array_keys($ret['Nodes']['SMSGroup']));

					$info = $ret['Count']['value']>1?$ret['Nodes']['SMSGroup']:array($ret['Nodes']['SMSGroup']);
				} else {
					$info = array();
				}


				return array('errorno'=>0, 'info'=>$info);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}
		}
		return array('errorno'=>-1, 'info'=>'发送短信请求失败');
	}

	public function addNewAccount($account, $pwd, $signNameID, $memo='UCS Created') {
		if (!$this->TokenId) die('未登录');
		$url = "http://www.mxtong.net.cn/GateWay/Services.asmx/AddSubAccount";
		$param = array('Token'=>$this->TokenId, 'Account'=>$account, 'Password'=>$pwd, 'SignNameID'=>$signNameID, 'Memo'=>$memo);
		$output = SMSClient::_curl_post($url, $param);
		$data = xml2array($output);
		//print_r($data);
		if ($data) {
			$ret = $data['ROOT'];

			if ($ret['RetCode']['value'] == 'Sucess' || !$info['count']) {
				return array('errorno'=>0);
			} else {
				return array('errorno'=>-1, 'info'=>$ret['Message']['value']);
			}
		}
		return array('errorno'=>-1, 'info'=>'发送短信请求失败');
	}
}