<?php
    /**
     * 取得所有用户的金币,钻石,奖券
     */
 mysql_connect('127.0.0.1','game','no.1@China!game');
 mysql_select_db('game');
 mysql_set_charset('utf8');
header('content-type:text/html;charset=utf-8');

 $sql = "SELECT a.items,a.items_num,b.login_name,b.nickname,b.user_id,b.diamond FROM game.profile a LEFT JOIN xinfeng.xf_user b ON a.user_id = b.user_id WHERE is_robot = 0";
 $r = mysql_query($sql);
 $table = "<meta charset='utf-8' /><table style='width:100%;text-align:center' ><tr>";
 $table .= "<th>uid</th>";
 $table .= "<th>用户名</th>";
 $table .= "<th>昵称</th>";
 $table .= "<th>金币</th>";
 $table .= "<th>钻石</th>";
 $table .= "<th>奖券</th>";
 $table .= "</tr>";
 while($row = mysql_fetch_assoc($r)){
   $row['coins'] = 0;
   $row['coupon'] = 0;
   if(!empty($row['items'])){
          $items = explode(',',$row['items']);
          $items_num = explode(',',$row['items_num']);
          $coinsFlag = null;
          $couponFlag = null;
          $flag = 0;
          foreach($items as $i){
            if($i == 0)
                $coinsFlag = $flag;
            else if($i == 2)
                $couponFlag = $flag;
            $flag++;
          }

          if($coinsFlag !== null)
              $row['coins'] = $items_num[$coinsFlag];

          if($couponFlag !== null)
                $row['coupon'] = $items_num[$couponFlag];
   }
   $table .= "<tr>";
   $table .= "<td>{$row['user_id']}</td>";
   $table .= "<td>{$row['login_name']}</td>";
   $table .= "<td>{$row['nickname']}</td>";
   $table .= "<td>{$row['coins']}</td>";
   $table .= "<td>{$row['diamond']}</td>";
   $table .= "<td>{$row['coupon']}</td>";
   $table .= "</tr>";
 }
 $table .= '</table>';

 $fp = fopen('./user.html','a');
 fwrite($fp, $table);
 fclose($fp);
