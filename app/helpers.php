<?php

if (! function_exists('isAdminOrSuperAdmin')) {
    function isAdminOrSuperAdmin() {
        return Auth::user()->type() == 'admin' || Auth::user()->type() == 'superadmin';
    }
}

if (! function_exists('checkRoute')) {
    function checkRoute($admin_route, $host_route) {
        $route = isAdminOrSuperAdmin() ? $admin_route : $host_route;
        return $route;
    }
}

// if (! function_exists('showImage')) {
//     function showImage($imageModel, $path) {
//         return
//     }
// }
