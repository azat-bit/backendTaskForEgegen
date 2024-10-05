<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Tüm kayıtları getir
    public function getAll()
    {
        return $this->model->all();
    }

    // Belirli bir id'ye göre kayıt getir
    public function findById($id)
    {
        return $this->model->find($id);
    }

    // Yeni kayıt oluştur
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Belirli bir id'ye göre kaydı güncelle
    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    // Belirli bir id'ye göre kaydı sil
    public function delete($id)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->delete();
            return true;
        }
        return false;
    }
}
