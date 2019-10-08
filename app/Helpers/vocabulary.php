<?php 

function getUserRole($role) {
    return $role == 1 ? 'Administrator': $role == 2 ? 'Manager' : 'Member';
}


function getVocaLink($word) {
    return '/vocabularies/'.$word;
}