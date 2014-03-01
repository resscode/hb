<?php

/*
 * Users config part
 */
// Default timezone for mysql, php

$config['default_timezone'] = 'UTC';

// Secret key for login operation
$config['default_secret_key'] = 'T%Gd@JjDbTsdnm^dJT$-bC1<VHv.X=AF';

// For creating users passwords blowfish 
$config['user_pass_blowfish'] = '7LiWkbRg9OZghj4TSAx5YgkcjZsEF5PJauCP6aeAf6yLRWQFegQrkXIzBxOYPneF';

// For creating api requests blowfish 
$config['api_blowfish'] = '7LiWkbRg9OZghj4TSAx5YgkcjZsEF5PJauCP6aeAf6yLRWQFegQrkXIzBxOYPneF';

// Time of the sign available for the SecurityMethods in sec
$config['sign_lifetime'] = 9999999999;

// the lifetime of the code for the temporary password 
$config['temp_password_lifetime'] = 1800;

// Temporary value agentId for Customer which type is Generic
$config['GenericAgentId'] = 111;

// Default package lifeTime period in sec (60*60*24*365)
$config['packageLifetime'] = 31536000;

// Default package renew period in sec (60*60*24*30)
$config['packageRenew'] = 2592000;

// Default Period when curent price seted in 0. In sec (60*60*24*14)
$config['priceInZeroPeriod'] = 2592000;

// Limits of the order attempts
$config['orderAttemptLimit'] = 3;

// User roles used in project
$config['userRoles'] = array(
    0 => 'admin',
    1 => 'customer',
    2 => 'manager',
    3 => 'agent'
);

$config['defaultLan']="EN"
?>
