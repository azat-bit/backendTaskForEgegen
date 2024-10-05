<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;

class HaberlerController extends Controller
{
    protected $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    // Haber ekleme
    public function store(Request $request)
{
    try {
        // Validation işlemi
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Görsel validation
        ]);
        // Görselin var olup olmadığını kontrol et
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Görseli 800x800 piksele kadar yeniden boyutlandır ve WebP formatında kaydet
            $img = Image::make($image->getRealPath())->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // Görseli 'public/uploads' dizinine WebP formatında kaydet
            $filePath = public_path('uploads');
            $fileName = uniqid() . '.webp';
            $img->save($filePath . '/' . $fileName, 80, 'webp');

            // Görsel yolunu validasyon edilmiş verilere ekle
            $validated['image'] = $fileName;
        }
        // Service üzerinden haber ekleme işlemi
        $news = $this->newsService->createNews($validated);
        return response()->json([
            'message' => 'Haber başarıyla eklendi',
            'data' => $news
        ], 201);
        
    } catch (ValidationException $e) {
        // Validation hatası durumunda dönecek hata mesajları
        return response()->json([
            'message' => 'Doğrulama hatası oluştu.',
            'errors' => $e->errors()  // Validation hatalarını daha detaylı döner
        ], 422);

    } catch (\Exception $e) {
        // Genel bir hata oluştuğunda
        return response()->json([
            'message' => 'Haber eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.',
            'error' => $e->getMessage() // Hata mesajı
        ], 500);
    }
}
    // Haber silme
    public function destroy($id)
    {
        // Service üzerinden haber silme işlemi
        $deleted = $this->newsService->deleteNews($id);

        if ($deleted) {
            return response()->json(['message' => 'Haber başarıyla silindi'], 200);
        }
        return response()->json(['message' => 'Haber bulunamadı'], 404);
    }
}
