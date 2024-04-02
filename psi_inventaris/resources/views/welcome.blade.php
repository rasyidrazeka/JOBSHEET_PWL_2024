<?php
// Include library TCPDF
require_once('tcpdf/tcpdf.php');

// Membuat objek TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Atur informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Sample PDF Report');
$pdf->SetSubject('Sample PDF Report using TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, report');

// Atur ukuran halaman
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Atur ukuran font
$pdf->SetFont('helvetica', '', 12);

// Tambahkan halaman baru
$pdf->AddPage();

// Tambahkan konten ke PDF
$html = '<h1>Sample PDF Report</h1>
         <p>This is a sample PDF report created using TCPDF in PHP.</p>
         <table border="1">
             <tr>
                 <th>Name</th>
                 <th>Age</th>
                 <th>Email</th>
             </tr>
             <tr>
                 <td>John Doe</td>
                 <td>30</td>
                 <td>john.doe@example.com</td>
             </tr>
             <tr>
                 <td>Jane Smith</td>
                 <td>25</td>
                 <td>jane.smith@example.com</td>
             </tr>
         </table>';

// Tambahkan konten HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF ke browser atau simpan ke file
$pdf->Output('sample_report.pdf', 'D'); // D untuk output ke browser, G untuk simpan ke file dengan nama sample_report.pdf

// Selesai
exit;
?>
