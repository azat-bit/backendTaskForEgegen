<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class HaberlerService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    // Kayıt ekleme işlemi
    public function createNews(array $data)
    {
        // Ekstra iş mantığı burada uygulanabilir (örneğin, validation, formatlama, vb.)
        return $this->newsRepository->create($data);
    }

    // Kayıt silme işlemi
    public function deleteNews($id)
    {
        // Ekstra iş mantığı burada uygulanabilir (örneğin, ek kontrol mekanizmaları)
        return $this->newsRepository->delete($id);
    }
}
