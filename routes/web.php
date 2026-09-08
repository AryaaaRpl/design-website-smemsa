<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/peta-kampus', function () {
    return view('peta-kampus');
});

Route::get('/visi-misi', function () {
    return view('visi-misi');
});

Route::get('/lsp', function () {
    return view('lsp');
});

Route::get('/bkk', function () {
    return view('bkk');
});

Route::get('/spmb', function () {
    return view('spmb');
});

Route::get('/ekstrakurikuler', function () {
    return view('ekstrakurikuler');
});

Route::get('/prestasi', function () {
    return view('prestasi');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/guru', function () {
    return view('guru');
});

Route::get('/fasilitas', function () {
    return view('fasilitas');
});
