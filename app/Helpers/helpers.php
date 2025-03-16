<?php

use App\Models\Role;
use App\Models\User;




function role() {
    $admindata = User::where("email", "=", session()->get("email"))->first();

    if ($admindata) {
        $roleid = $admindata->role_id;
        $roledata = Role::where("id", "=", $roleid)->first();

        if ($roledata) {
            return $roledata; // Return the entire Role object
        } else {
            return null;
        }

    } else {
        return null;
    }
}
?>
