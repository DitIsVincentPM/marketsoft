<?php 

Broadcast::channel('events', function ($user) {
    return true;
});
