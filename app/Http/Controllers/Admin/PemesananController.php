<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PemesananExport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pesan::with(['member', 'paketwisata'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.page.pemesanan.index', compact('pemesanans'));
    }

    public function exportExcel()
    {
        try {
            // Check if data exists
            $count = Pesan::count();
            if ($count == 0) {
                return redirect()->back()->with('warning', 'Tidak ada data untuk diexport');
            }

            $fileName = 'pemesanan_' . date('Y-m-d_H-i-s') . '.xlsx';

            // Use response()->download() for better error handling
            return Excel::download(new PemesananExport, $fileName, \Maatwebsite\Excel\Excel::XLSX, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
        } catch (\Exception $e) {
            Log::error('Excel Export Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengexport Excel. Silakan coba lagi.');
        }
    }

    public function exportPdf()
    {
        try {
            $pemesanans = Pesan::with(['member', 'paketwisata'])
                ->orderBy('created_at', 'desc')
                ->get();

            $pdf = Pdf::loadView('admin.exports.pemesanan_pdf', compact('pemesanans'));
            $pdf->setPaper('A4', 'landscape');

            $fileName = 'pemesanan_' . date('Y-m-d_H-i-s') . '.pdf';
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengexport PDF: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pemesanan = Pesan::with(['member', 'paketwisata'])->findOrFail($id);
        return view('admin.page.pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dibayar,diverifikasi,selesai,dibatalkan'
        ]);

        $pemesanan = Pesan::findOrFail($id);
        $pemesanan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
