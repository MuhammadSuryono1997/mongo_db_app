<?php
namespace App\Database;
use MongoDB\Client;
// require __DIR__.'/../../vendor/autoload.php';

class DatabaseClass
{
    public $client;
    public function __construct()
    {
        $this->client = new Client("mongodb://127.0.0.1:27017");
    }

    public function db()
    {
        return $this->client->db_company;
    }

    public function select($table)
    {
        return $this->client->db_company->$table->find([]);
    }

    public function select_where($table,$data)
    {
        return $this->client->db_company->$table->findOne($data);
    }

    public function insert($table, $data)
    {
        return $this->client->db_company->$table->insertOne($data);
    }

    public function update($table, $id,$data)
    {
        return $this->client->db_company->$table->updateOne($id, ['$set'=>$data]);
    }

    public function delete($table,$id)
    {
        return $this->client->db_company->$table->deleteOne($id);
    }
    


}

// $db = new DatabaseClass();
// $db->delete('departement', (object)['dept_no'=> 'd002']);
// $data = $db->select('departement');
// foreach($data as $d)
// {
//     var_dump($d);
// }