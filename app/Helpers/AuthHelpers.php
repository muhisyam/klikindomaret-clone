<?php

use App\Models\Role;
use Illuminate\Http\Request;

// MARK: Get auth token.  
/**
 * Get auth token from auth session.
*/
function getAuthToken($type = 'Bearer') {
    return session('auth') 
        ? $type . ' ' . session('auth')['token']
        : '';
}

// MARK: Get auth username. 
/**
 * Get auth username from auth session.
*/
function getAuthUsername() {
    return session('auth') 
        ? session('auth')['user']['username'] 
        : 'intruder';
}

// MARK: Get auth fullname. 
/**
 * Get auth fullname from auth session.
*/
function getAuthFullname() {
    return session('auth') 
        ? session('auth')['user']['fullname'] 
        : 'intruder';
}

// MARK: Check is god role. 
/**
 * The role of God is a role with unlimited access.
*/
function isGodRole() {
    if (config('app.god_mode')) return true;

    $role = session('auth') 
        ? session('auth')['user']['role']['role_name']
        : 'Intruder';

    return $role === Role::ROLE_GOD;
}

// MARK: Check is super role.
/**
 * The super role is that of a supervisor or god.
*/
function isSuperRole() {
    if (config('app.god_mode')) return true; 

    $role = session('auth') 
        ? session('auth')['user']['role']['role_name']
        : 'Intruder';

    return in_array($role, Role::ROLE_SUPER);
}

// MARK: With god access.
/**
 * Add god parameter to the endpoint.
 * 
 * @return string param god=true
*/
function withGodAccess(string $delimiter) {
    if (config('app.god_mode')) return $delimiter . 'god=true';
}

// MARK: Has god access.
/**
 * Check god parameter exists in endpoint.
 * 
 * @return \Illuminate\Http\Request $request
*/
function hasGodAccess(Request $request) {
    return ! is_null($request->god) ? true : false;
}
