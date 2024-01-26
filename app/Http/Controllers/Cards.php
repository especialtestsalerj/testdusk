<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Services\QrCode\Service;
use File;
use Illuminate\Http\Request;
use App\Services\PDF\Service as PDF;
use Illuminate\Support\Str;
class Cards extends Controller
{
    public function download(Request $request)
    {
        $this->increaseTimeAndMemoryLimits();

        [$startId, $endId] = [$request->query('startId'), $request->query('endId')];

        $cards = Card::where('id', '>=', $startId)
            ->where('id', '<=', $endId)
            ->get();

        $filesCreated = collect();
        $folderPath = storage_path('app/tmp/pdfs/');
        $zipFilePath = storage_path('app/tmp');
        $zipFileName = Str::slug('cards-' . now()->format('Y m d H i')) . '.zip';
        $zip = new \ZipArchive();
        $fullZipFilePath = $zipFilePath . '/' . $zipFileName;

        $this->generatePdfFilesandAttachToZip(
            $cards,
            $filesCreated,
            $folderPath,
            $zip,
            $zipFilePath,
            $zipFileName,
            $fullZipFilePath
        );

        $zip->close();

        $this->cleanPdfFiles($filesCreated);

        return response()
            ->download($fullZipFilePath, $zipFileName)
            ->deleteFileAfterSend(true);
    }

    /**
     * @param \Vanilla\Support\Collection|\IlluminateAgnostic\StrAgnostic\Str\Support\Collection|\IlluminateAgnostic\Str\Support\Collection|\IlluminateAgnostic\Collection\Support\Collection|\Tightenco\Collect\Support\Collection|\IlluminateAgnostic\ArrAgnostic\Arr\Support\Collection|\Illuminate\Support\Collection|\IlluminateAgnostic\Arr\Support\Collection $filesCreated
     * @return void
     */
    protected function cleanPdfFiles(
        \Vanilla\Support\Collection|\IlluminateAgnostic\StrAgnostic\Str\Support\Collection|\IlluminateAgnostic\Str\Support\Collection|\IlluminateAgnostic\Collection\Support\Collection|\Tightenco\Collect\Support\Collection|\IlluminateAgnostic\ArrAgnostic\Arr\Support\Collection|\Illuminate\Support\Collection|\IlluminateAgnostic\Arr\Support\Collection $filesCreated
    ): void {
        $filesCreated->each(function ($filePath) {
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        });
    }

    /**
     * @param $cards
     * @param \Vanilla\Support\Collection|\Tightenco\Collect\Support\Collection|\IlluminateAgnostic\Str\Support\Collection|\IlluminateAgnostic\StrAgnostic\Str\Support\Collection|\IlluminateAgnostic\Collection\Support\Collection|\IlluminateAgnostic\ArrAgnostic\Arr\Support\Collection|\Illuminate\Support\Collection|\IlluminateAgnostic\Arr\Support\Collection $filesCreated
     * @param string $folderPath
     * @param \ZipArchive $zip
     * @param string $zipFilePath
     * @param string $zipFileName
     * @param string $fullZipFilePath
     * @return void
     * @throws \Throwable
     */
    protected function generatePdfFilesandAttachToZip(
        $cards,
        \Vanilla\Support\Collection|\Tightenco\Collect\Support\Collection|\IlluminateAgnostic\Str\Support\Collection|\IlluminateAgnostic\StrAgnostic\Str\Support\Collection|\IlluminateAgnostic\Collection\Support\Collection|\IlluminateAgnostic\ArrAgnostic\Arr\Support\Collection|\Illuminate\Support\Collection|\IlluminateAgnostic\Arr\Support\Collection $filesCreated,
        string $folderPath,
        \ZipArchive $zip,
        string $zipFilePath,
        string $zipFileName,
        string $fullZipFilePath
    ): void {
        $cards->each(function ($card) use (
            $filesCreated,
            $folderPath,
            $zip,
            $zipFilePath,
            $zipFileName,
            $fullZipFilePath
        ) {
            $filePath = $folderPath;
            $fileName = $card->number . '.pdf';
            $fullPath = $filePath . $fileName;

            $this->createPdfFile($card, $fullPath);

            $filesCreated->push($fullPath);

            $this->attachFileToZip($zip, $fullZipFilePath, $fullPath);
        });
    }

    /**
     * @param $card
     * @param string $fullPath
     * @return void
     * @throws \Throwable
     */
    function createPdfFile($card, string $fullPath): void
    {
        app(PDF::class)
            ->initialize(
                view('cards.qr-code')
                    ->with(['uri' => $card->qr_code_uri])
                    ->render(),
                [0, 0, 113.386, 113.386]
            )
            ->save($fullPath);
    }

    /**
     * @param \ZipArchive $zip
     * @param string $fullZipFilePath
     * @param string $fullPath
     * @return void
     */
    function attachFileToZip(\ZipArchive $zip, string $fullZipFilePath, string $fullPath): void
    {
        if ($zip->open($fullZipFilePath, \ZipArchive::CREATE) == true) {
            $relativeName = basename($fullPath);
            $zip->addFile($fullPath, $relativeName);
        }
    }

    /**
     * @return void
     */
    protected function increaseTimeAndMemoryLimits(): void
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
    }
}
