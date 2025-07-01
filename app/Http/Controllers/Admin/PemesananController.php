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
            // Increase memory limit and execution time
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 300);

            // Check if data exists
            $count = Pesan::count();
            if ($count == 0) {
                return redirect()->back()->with('warning', 'Tidak ada data untuk diexport');
            }

            Log::info('Starting Excel export with ' . $count . ' records');

            // Test the export class first
            $export = new PemesananExport();
            $testCollection = $export->collection();

            if ($testCollection->isEmpty()) {
                return redirect()->back()->with('warning', 'Data kosong atau tidak dapat diambil');
            }

            $fileName = 'pemesanan_' . date('Y-m-d_H-i-s') . '.xlsx';

            Log::info('Excel export starting for file: ' . $fileName);

            // Simplified download call
            return Excel::download(new PemesananExport, $fileName);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::error('Excel Validation Error: ' . json_encode($e->failures()));
            return redirect()->back()->with('error', 'Validasi Excel gagal: ' . implode(', ', $e->failures()));
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            Log::error('PhpSpreadsheet Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Error PhpSpreadsheet: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Excel Export Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengexport Excel: ' . $e->getMessage());
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
