<?php

$books = [
    [
        "name" => "Atomic Habits",
        "author" => "Andy Weir",
        "releaseYear" => 2019,
        "purchaseUrl" => "https://www.example.com"
    ],
    [
        "name" => "The subtle art of not giving a fuck",
        "author" => "Philip K. Dick",
        "releaseYear" => 2020,
        "purchaseUrl" => "https://www.polo.com"
    ],
    [
        "name" => "The Alchemist",
        "author" => "Chinaswamy Mutuswamy",
        "releaseYear" => 2021,
        "purchaseUrl" => "https://www.laadle.com"
    ]
];

$filteredBooks = array_filter($books, function($book) {
    return $book['name'] === "The Alchemist";
});

include "index.view.php";