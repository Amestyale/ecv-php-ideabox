<?php

const SQL_ERROR_DUPLICATE_UNIQUE = 23000;

const ERRORS = [
    "email" => [
        "miss" => "L'email est requis",
        "format" => "Le format de l'email est incorrect",
        "used" => "Cette adresse mail est déjà utilisée"
    ],
    "password" => [
        "miss" => "Le mot de passe est requis",
        "missmatch" => "Les mots de passe ne coïncident pas"
    ],
    "confirm-password" => [
        "miss" => "La confirmation de mot de passe est requise",
        "missmatch" => "Les mots de passe ne coïncident pas"
    ],
    "login" => [
        "missmatch" => "La combinaison adresse mail/mot de passe est incorrecte"
    ],
];