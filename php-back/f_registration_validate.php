<?php
function validate($data)
{
extract($data);
if( !inputvalidate('regex',array($univ_roll=>'num',$access_code=>'alphanum',$department=>'alpha')) )
    return 'Invalid input / Only Alphanumeric characters(a-z, A-Z, 0-9), underscores(_) and hyphens(-) allowed.';
if( !inputvalidate('exact-length',array($univ_roll=>10,$access_code=>9)) )
    return 'University roll incorrect length, please input 10 characters / Access code incorrect length, please input 9 characters';
if( !inputvalidate('min-length',array($pass=>6)) )
    return 'Password is of incorrect length, please input atleast 6 characters.';
return 'true';
}
?>