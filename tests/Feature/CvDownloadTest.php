<?php

use Barryvdh\DomPDF\Facade\Pdf;

test('halaman cv menampilkan tombol download pdf', function () {
    $this->get(route('cv'))
        ->assertOk()
        ->assertSee('Download PDF')
        ->assertSee('Ringkasan Profil');
});

test('cv dapat diunduh sebagai pdf', function () {
    $response = $this->get(route('cv.download'));

    $response->assertOk();

    expect($response->headers->get('content-type'))->toContain('application/pdf')
        ->and($response->headers->get('content-disposition'))
        ->toContain('attachment')
        ->toContain('.pdf');
});

test('pdf cv hanya satu halaman', function () {
    $pdf = Pdf::loadView('cv-pdf')->setPaper('a4');
    $dompdf = $pdf->getDomPDF();
    $dompdf->render();

    expect($dompdf->getCanvas()->get_page_count())->toBe(1);
});
