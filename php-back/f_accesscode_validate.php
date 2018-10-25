<?php
function validate($data)
{
extract($data);
if( !inputvalidate('max-length',array($allowed_users=>3,$department=>3)) )
    return 'Allowed users/Department invalid, input max 3 characters';
if( !inputvalidate('exact-length',array($batch=>4)) )
    return 'Batch invalid, input exactly 4 characters';
if( !inputvalidate('max-length',array($section=>1)) )
    return 'Section invalid, maximum 1 character';
return 'valid';
}
?>