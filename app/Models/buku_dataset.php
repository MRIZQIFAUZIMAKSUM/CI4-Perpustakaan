<?php namespace App\Models;

use CodeIgniter\Model;

class buku_dataset extends Model{
  protected $table = 'book_dataset';
  protected $allowedFields = ['ISBN', 'Book-Title', 'Book-Author','Year-Of-Publication', 'Publisher','Image-URL-S','Image-URL-M','Image-URL-L','created_at','updated_at' ];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];
  
  protected function beforeInsert(array $data){
    $data['data']['created_at'] = date('Y-m-d');

    return $data;
  }

  protected function beforeUpdate(array $data){
    $data['data']['updated_at'] = date('Y-m-d');
    return $data;
  }

}
?>
