<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id && $user->hasRole(['admin', 'superAdmin']);
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});