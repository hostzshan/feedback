<?php
function validate($data)
{
$arr=array();
foreach($data as $x => $x_value)
{
    $arr[$x_value]=10;
}
if( !inputvalidate('max-value',$arr) )
    return 'Score (should be less than 11) invalid';
return 'valid';
}
?>