<?php
#xfs_setting($_GET['dir'],$_GET['bs'],$_GET['bh'],$_GET['mod']);
$ttmp=shell_exec('sudo xfs_quota -x -c \'report\' /media');
echo nl2br($ttmp);

function xfs_setting($xfs_dir,$xfs_bsoft,$xfs_bhard,$xfs_state){
# $xfs_dir      the directory name of quota project,
#               this directiry will auto make by system
# $xfs_bsoft    the soft bandwave of project, 
#               please modify with unit, EX: 100M, 1G.
# $xfs_bhard    the soft bandwave of project, 
#               please modify with unit, EX: 100M, 1G.
# $xfs_state    the state of this method, 
#               'add' for new quota project,
#               'mod' for limit modify of project,
#               'del' for quota cancel
# $xfs_base     the mount point of xfs partition
#

$xfs_base='/media';
$xfs_fulldir=$xfs_base.'/'.$xfs_dir;
$fp=fopen('projid',"r");
list($tmp,$xfs_lastid)=split('[#]',fgets($fp,1024));
fclose($fp);
$xfs_lastid = (int)$xfs_lastid;

switch($xfs_state){
case add:
if($xfs_dir != '' && $xfs_bsoft != '' && $xfs_bhard != ''){
$str = 'mkdir '.$xfs_fulldir;
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
$str = 'echo '.(++$xfs_lastid).':'.$xfs_fulldir.' >> projects 2>&1';
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
$str = 'echo '.$xfs_dir.':'.$xfs_lastid.' >> projid 2>&1';
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
$str = 'sudo xfs_quota -x -c \'project -s '.$xfs_dir.'\' '.$xfs_base;
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
$str = 'sudo xfs_quota -x -c \'limit -p bsoft='.$xfs_bsoft.' bhard='.$xfs_bhard.' '.$xfs_dir.'\' '.$xfs_base;
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
$str = 'sed -i \'s/#'.(--$xfs_lastid).'/#'.(++$xfs_lastid).'/g\' projid 2>&1';
$tmp=shell_exec($str);
#echo $str.':'.$tmp.'<br>';
}else{
echo 'please check your setting';
}
break;

case mod:
if($xfs_dir != '' && $xfs_bsoft != '' && $xfs_bhard != ''){
$str = 'sudo xfs_quota -x -c \'limit -p bsoft='.$xfs_bsoft.' bhard='.$xfs_bhard.' '.$xfs_dir.'\' '.$xfs_base;
$tmp=shell_exec("$str");
#echo $str.$tmp;
}elseif($xfs_dir != '' && $xfs_bsoft != ''){
$str = 'sudo xfs_quota -x -c \'limit -p bsoft='.$xfs_bsoft.' '.$xfs_dir.'\' '.$xfs_base;
$tmp=shell_exec("$str");
#echo $str.$tmp;
}elseif($xfs_dir != '' && $xfs_bhard != ''){
$str = 'sudo xfs_quota -x -c \'limit -p bhard='.$xfs_bhard.' '.$xfs_dir.'\' '.$xfs_base;
$tmp=shell_exec("$str");
#echo $str.$tmp;
}else{
echo 'please check your setting';
}
break;

case del:
if($xfs_dir != ''){
$str = 'sudo xfs_quota -x -c \'limit -p bsoft=0 bhard=0 '.$xfs_dir.'\' '.$xfs_base.' 2>&1';
$tmp=shell_exec($str);
#echo $tmp;
$str = 'sed -i -e \'/'.$xfs_dir.'/d\' projects 2>&1';
$tmp=shell_exec($str);
#echo $tmp;
$str = 'sed -i -e \'/'.$xfs_dir.'/d\' projid 2>&1';
$tmp=shell_exec($str);
#echo $tmp;
$str = 'sudo rm -rf '.$xfs_fulldir;
$tmp=shell_exec($str);
#echo $tmp;

}else{
echo 'please check your setting';
}
break;

default:
echo 'fail to setting xfs quota!!!please check your setting';
}
}

?>
