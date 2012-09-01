<?php
class KyoClass{
	//check
	public function check_chongfu($table,$ziduan,$testname)//重复返回true
	{
		$result = mysql_query("select * from $table where $ziduan='$testname'");
		if(mysql_affected_rows() > 0) return true;
		else return false;
	}
}

?>