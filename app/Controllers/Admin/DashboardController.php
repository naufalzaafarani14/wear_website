<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use App\Models\ItemFashionModel;
use App\Models\OutfitModel;
use App\Models\BrandModel;
use App\Models\KontenFashionModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $penggunaModel = new PenggunaModel();
        $itemModel     = new ItemFashionModel();
        $outfitModel   = new OutfitModel();
        $brandModel    = new BrandModel();
        $kontenModel   = new KontenFashionModel();

        $db = \Config\Database::connect();

        // Statistik utama
        $totalPengguna    = $penggunaModel->countAll();
        $totalItemFashion = $itemModel->countAll();
        $totalOutfit      = $outfitModel->countAll();
        $totalBrand       = $brandModel->countAll();
        $totalInspirasi   = $kontenModel->where('jenis_konten', 'Fashion Inspiration')->countAllResults();
        $totalArtikelPub  = $kontenModel->where('jenis_konten', 'Artikel')->where('status', 'Published')->countAllResults();

        // Fashion overview
        $itemPublished   = $itemModel->where('status', 'Published')->countAllResults();
        $itemDraft       = $itemModel->where('status', 'Draft')->countAllResults();
        $outfitPublished = $outfitModel->where('status', 'Published')->countAllResults();
        $outfitDraft     = $outfitModel->where('status', 'Draft')->countAllResults();

        // Konten terbaru: gabungan Outfit + Konten Fashion (Artikel/Inspirasi/Budaya)
        $sqlTerbaru = "
            SELECT nama_outfit AS nama, 'Outfit' AS tipe, status, created_at AS tanggal
            FROM outfit
            UNION ALL
            SELECT judul AS nama, jenis_konten AS tipe, status, tanggal_dibuat AS tanggal
            FROM konten_fashion
            ORDER BY tanggal DESC
            LIMIT 8
        ";
        $kontenTerbaru = $db->query($sqlTerbaru)->getResultArray();

        // Content overview: jumlah tiap jenis konten
        $sqlOverview = "
            SELECT jenis_konten AS tipe, COUNT(*) AS jumlah
            FROM konten_fashion
            GROUP BY jenis_konten
        ";
        $contentOverview = $db->query($sqlOverview)->getResultArray();

        $data = [
            'totalPengguna'    => $totalPengguna,
            'totalItemFashion' => $totalItemFashion,
            'totalOutfit'      => $totalOutfit,
            'totalBrand'       => $totalBrand,
            'totalInspirasi'   => $totalInspirasi,
            'totalArtikelPub'  => $totalArtikelPub,
            'itemPublished'    => $itemPublished,
            'itemDraft'        => $itemDraft,
            'outfitPublished'  => $outfitPublished,
            'outfitDraft'      => $outfitDraft,
            'kontenTerbaru'    => $kontenTerbaru,
            'contentOverview'  => $contentOverview,
        ];

        return view('admin/dashboard', $data);
    }
}