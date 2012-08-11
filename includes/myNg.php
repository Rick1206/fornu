<?php
//echo num_to_gb(12);
//echo '<br/>';
//echo num_to_gb(12,1,false);
//echo '<br/>';
//echo num_to_gb(32.45,2);
//echo '<br/>';
//echo num_to_gb('2008-2-18');
//echo '<br/>';
/**
* 将数字转换成中文(阿拉伯数字转换成中文)
* @string $num 序列
* @int $mode 处理模式(1.删除前导零 2.小数部分不删除前导零 3.日期)
* @bool $lower 中文小写
* @int $conv 转换方式 (0.普通方式 1.逐位转换没有十百千万)
* @author:panzhiqi panzhiqi@126.com panzhiqi@gmail.com
* return 中文
*/
function num_to_day($num){
	switch($num){
		case "0":
			return "日";
		break;
		case "1":
			return "一";
		break;
		case "2":
			return "二";
		break;
		case "3":
			return "三";
		break;
		case "4":
			return "四";
		break;
		case "5":
			return "五";
		break;
		case "6":
			return "六";
		break;
	}
}
function num_to_gb($num,$mode=1,$lower=true,$conv=0) {
   $num_char = array('0','一','二','三','四','五','六','七','八','九','零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
   $num_unit = array('','十','百','千','','万','亿','兆','','拾','佰','仟','','萬','億','兆');
   $date_char = array('年','月','日');
   $decimal_point = array('点','點');
   if ($lower)
    $lo_flag = 0;
   else
    $lo_flag = 1;
  
   $result = '';
   switch($mode) {
    case 1:
     preg_match_all("/^0*(\d*)\.?(\d*)/",$num,$numbers);
     break;
    case 2:
     preg_match_all("/(\d*)\.?(\d*)/",$num,$numbers);
     break;
    case 3:
     preg_match_all("/^(\d*)\-(\d*)\-(\d*)$/",$num,$numbers);
     break;
    default:
     return null;
   }
   if (isset($numbers[3][0]) && !empty($numbers[3][0])) {
    // 日期格式
    return num_to_gb($numbers[1][0],1,$lower,1) . $date_char[0] . num_to_gb($numbers[2][0]) . $date_char[1] . num_to_gb($numbers[3][0]) . $date_char[2];
   }
   if (isset($numbers[2][0]) && !empty($numbers[2][0])) {
    // 小数
    $point = $decimal_point[ count($decimal_point)/2 * $lo_flag ];
    return num_to_gb($numbers[1][0],1,$lower) . $point . num_to_gb($numbers[2][0],2,$lower,1);
   }
   if (isset($numbers[1][0]) && !empty($numbers[1][0])) {
    // 整数
    $cur_num = $numbers[1][0];
    $st_char = count($num_char)/2 * $lo_flag;
    $st_unit = count($num_unit)/2 * $lo_flag;
    $out = array();
    switch ($conv) {
     // 日期方式
     case 1:
      for($i=0;$i<strlen($cur_num);$i++)
       $out[$i] = $num_char[ $st_char+$cur_num[$i] ];
      break;
     default:
      $cur_num_s = strrev($cur_num);
      for($i=0;$i < strlen($cur_num_s);$i++) {
       if ($i%4==1 && $cur_num>=10 && $cur_num<20) //去掉 '一'十一中的'一'
        $out[$i] = '';
       else
        $out[$i] = $num_char[ $st_char+$cur_num_s[$i] ];
       $out[$i] .= $cur_num_s[$i] != '0' ? $num_unit[ $st_unit+$i%4 ] : '';
       $pre_num = $i>0 ? $cur_num_s[$i-1] : 0;
       if($cur_num_s[$i]+$pre_num == 0)
        $out[$i] = '';
       if($i%4 == 0)
        $out[$i] .= $num_unit[ $st_unit+4+floor($i/4) ];
      }
      $out = array_reverse($out);
    }
    return join('',$out);
   }
   return null;
}