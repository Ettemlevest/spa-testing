<?php

Route::get('/', function () {
    return view('app');
});

Route::get('{any}', function () {
    return redirect('/');
});
