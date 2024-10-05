<?php

namespace App\Repositories;

use App\Models\News;

class HaberlerRepository
{
    protected $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }

    // Kayıt ekleme
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // Kayıt silme
    public function delete($id)
    {
        $news = $this->model->find($id);
        if ($news) {
            $news->delete();
            return true;
        }
        return false;
    }
}
