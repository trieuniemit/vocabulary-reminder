<?php 

function getRoleLabel($role) {
    return $role == 1 ? 'Administrator': $role == 2 ? 'Manager' : 'Member';
}

function getVocaLink($word) {
    return '/vocabularies/'.$word;
}

function getVocaTypes() {
    return [
       'danh từ' => 'Danh từ',
       'động từ' => 'Động từ',
       'trạng từ' => 'Trạng từ',
       'ngoại động từ' => 'Ngoại động từ',
       'tính từ' => 'Tính từ',
       'giới từ' => 'Giới từ'
   ];
}

function isAdmin() {
    return Auth::user()->role == 1;
}

function isManger() {
    return Auth::user()->role >=2;
}