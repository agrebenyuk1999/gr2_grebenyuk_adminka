<?php
require "Request.php";

$request = new Request;
$errors = [];

if ($request->isPost()) {
    $request->required('title')
        ->minSymbols('title', 3)
        ->maxSymbols('title', 255);

    $request->correctPublishDate('datePublish');

    $request->required('content')
        ->maxSymbols('content', 5000);

    $request->required('author')
        ->maxSymbols('author', 255);

    $isValid = $request->isValid();
    $errors = $request->getErrors();
}
