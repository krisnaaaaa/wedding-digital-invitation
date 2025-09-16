<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class JsonGuestService
{
    protected $filePath;

    public function __construct()
    {
        $this->filePath = public_path('guests.json');
        
        // Buat file jika belum ada
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    /**
     * Ambil semua data guest dari JSON
     */
    public function getAllGuests()
    {
        $content = file_get_contents($this->filePath);
        return json_decode($content, true) ?? [];
    }

    /**
     * Simpan data guest baru
     */
    public function store($data)
    {
        $guests = $this->getAllGuests();
        
        // Buat ID unik
        $newGuest = [
            'id' => uniqid(),
            'name' => $data['name'],
            'presence' => $data['presence'],
            'person' => $data['person'],
            'comment' => $data['comment'] ?? null,
            'created_at' => Carbon::now()->diffForHumans(),
            'timestamp' => Carbon::now()->toISOString()
        ];

        // Tambahkan di awal array (latest first)
        array_unshift($guests, $newGuest);

        // Simpan kembali ke file
        file_put_contents($this->filePath, json_encode($guests, JSON_PRETTY_PRINT));

        return $newGuest;
    }

    /**
     * Paginate data guest
     */
    public function paginate($perPage = 3, $page = null)
    {
        $guests = $this->getAllGuests();
        $page = $page ?: Paginator::resolveCurrentPage();
        $offset = ($page - 1) * $perPage;
        $items = array_slice($guests, $offset, $perPage);

        return new LengthAwarePaginator(
            $items,
            count($guests),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'pageName' => 'page',
            ]
        );
    }

    /**
     * Hapus guest berdasarkan ID (opsional untuk fitur masa depan)
     */
    public function delete($id)
    {
        $guests = $this->getAllGuests();
        $guests = array_filter($guests, function($guest) use ($id) {
            return $guest['id'] !== $id;
        });

        file_put_contents($this->filePath, json_encode(array_values($guests), JSON_PRETTY_PRINT));
        return true;
    }
}
