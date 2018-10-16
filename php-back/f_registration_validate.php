<?php
function validate($data)
{
extract($data);
if( !inputvalidate('exact-length',array($univ_roll=>10)) )
    return 'University roll incorrect length, please input 10 characters.';
if( !inputvalidate('min-length',array($pass=>6)) )
    return 'Password is of incorrect length, please input atleast 6 characters.';
}
?>