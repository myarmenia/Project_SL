<?php

namespace App\Exports;

use App\Models\Report;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;

class SignalsExport implements FromArray, WithEvents
{

    public int $columns_count = 30;
    public string $doc_title;
    public int $total_row_count = 0;
    private string $from;
    private string $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->doc_title = sprintf('Տեղեկություն %s - %s ժամանակահատվածում ՀՀ ԱԱԾ օպերատիվ ստորաբաժանումների կողմից ահազանգերով տարվող աշխատանքների և դրանց արդյունքների վերաբերյալ', Carbon::createFromFormat('Y-m-d', $from)->format('d-m-Y'), Carbon::createFromFormat('Y-m-d', $to)->format('d-m-Y'));

    }

    public function array(): array
    {
        $data = Report::getSignalsAlerts($this->from, $this->to)->toJson();
        $result = json_decode($data, true);
        $this->total_row_count = count($result) + 2;

        $totals = ['ԸՆԴԱՄԵՆԸ'];
        for ($j = 2; $j <= $this->columns_count; $j++) {
            $col = Coordinate::stringFromColumnIndex($j);
            $col_range = sprintf('SUM(%s4:%s%d)', $col, $col, $this->total_row_count);
            $func = sprintf('=IF(%s<>0,%s,"")', $col_range, $col_range);

            $totals[] = $func;
        }

        return [
            [''],
            [''],
            [''],
            $result,
            $totals
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $headersRange = 'A1:AD3';

                $event->sheet->getHeaderFooter()->setDifferentOddEven(false);

                $event->sheet->getSheetView()->setView(SheetView::SHEETVIEW_PAGE_LAYOUT);
                $event->sheet->getPageSetup()->SetPaperSize(PageSetup::PAPERSIZE_A4);
                $event->sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->getDelegate()->getPageMargins()->setHeader(0.5);
                $event->sheet->getDelegate()->getPageMargins()->setFooter(1.3);
                $event->sheet->getDelegate()->getPageMargins()->setTop(2.8);
                $event->sheet->getDelegate()->getPageMargins()->setRight(0.7);
                $event->sheet->getDelegate()->getPageMargins()->setLeft(0.5);
                $event->sheet->getDelegate()->getPageMargins()->setBottom(0.4);


                $event->sheet->getHeaderFooter()->setDifferentOddEven(false);
                $event->sheet->getHeaderFooter()->setOddHeader($this->doc_title);
                $headers = $event->sheet->getDelegate()->getStyle($headersRange);

                $event->sheet->getDelegate()->getStyle('A1:AD' . $this->total_row_count + 2)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_DOUBLE,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                for ($i = 1; $i <= $this->columns_count; $i++) {
                    $col = Coordinate::stringFromColumnIndex($i);
                    $event->sheet->getDelegate()->getColumnDimension($col)->setWidth(4);
                }


                $headers->getFont()
                    ->setSize(8)
                    ->setName('Times Armenian');

                $headers->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center');

                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(50);
                $event->sheet->getDelegate()->getRowDimension(3)->setRowHeight(210);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);

                $event->sheet->getDelegate()
                    ->setCellValue('A1', 'ՀՀ ԱԱԾ ստորաբաժանումը')
                    ->getStyle('A1')
                    ->getFont()
                    ->setSize(11)
                    ->setBold(true);

                $event->sheet->getDelegate()
                    ->getStyle('A' . $this->total_row_count + 1)
                    ->getFont()
                    ->setSize(10)
                    ->setBold(true);

                $event->sheet->getDelegate()
                    ->getStyle('A4:A' . $this->total_row_count + 1)
                    ->getAlignment()
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle('A4:A' . $this->total_row_count)
                    ->getFont()
                    ->setSize(9)
                    ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->getStyle("B1")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);


                $event->sheet->getDelegate()->mergeCells('A1:A3');
                $event->sheet->getDelegate()->mergeCells('B1:B3');

                $event->sheet->getDelegate()->setCellValue('B1', sprintf('%s դրությամբ վարույթում գտնվող ահազանգերը', $this->from));
                $event->sheet->getDelegate()->mergeCells('C1:F1')->setCellValue('C1', 'Գրանցվել է');
                $event->sheet->getDelegate()->mergeCells('C2:C3')->setCellValue('C2', sprintf('ընդամենը %s - %s', $this->from, $this->to));

                $event->sheet->getDelegate()->getStyle("C2:C3")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->mergeCells('D2:F2')
                    ->setCellValue('D2', 'Տեղեկության աղբյուրը')
                    ->getStyle("D2:F2")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle("D3:F3")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->setCellValue('D3', 'X');
                $event->sheet->getDelegate()->setCellValue('E3', 'Y');
                $event->sheet->getDelegate()->setCellValue('F3', 'Z');

                $event->sheet->getDelegate()->mergeCells('G1:G3')
                    ->setCellValue('G1', 'Ահազանգը ստացվել է այլ ստորաբաժանումից')
                    ->getStyle('G1:G3')
                    ->getAlignment()
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->mergeCells('H1:Z1')->setCellValue('H1', 'Ահազանգի ստուգումը դադարեցվել է');
                $event->sheet->getDelegate()->mergeCells('H2:H3')
                    ->setCellValue('H2', sprintf('ընդամենը %s - %s', $this->from, $this->to))
                    ->getStyle('H2:H3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->mergeCells('I2:R2')->setCellValue('I2', 'Ահազանգը հաստատվել է');

                $event->sheet->getDelegate()
                    ->getStyle("I3:Y3")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->setCellValue('I3', 'հարուցվել է քրեական գործ');
                $event->sheet->getDelegate()->setCellValue('J3', 'գրանցվել է ՕՀԳ կամ ՕՀ');
                $event->sheet->getDelegate()->setCellValue('K3', 'հայտարարվել է պաշտոնական նախազգուշացում');
                $event->sheet->getDelegate()->setCellValue('L3', 'անցկացվել է կանխարգելիչ միջոցառում');
                $event->sheet->getDelegate()->setCellValue('M3', 'զենքի և ռազմամթերքի կամավոր հանձնում');
                $event->sheet->getDelegate()->setCellValue('N3', 'օբյեկտը կրել է վարչական տույժ');
                $event->sheet->getDelegate()->setCellValue('O3', 'նյութերը փոխանցվել են ՔՎ');
                $event->sheet->getDelegate()->setCellValue('P3', 'նյութերը փոխանցվել են ՀՀ ոստիկանություն, դատախազություն');
                $event->sheet->getDelegate()->setCellValue('Q3', 'տեղեկացվել են շահագրգիռ պետական այլ մարմիններ');
                $event->sheet->getDelegate()->setCellValue('R3', 'իրականացվել են այլ միջոցառումներ');

                $event->sheet->getDelegate()->mergeCells('S2:Y2')->setCellValue('S2', 'Ստուգումը դադարեցվել է');

                $event->sheet->getDelegate()->setCellValue('S3', 'նյութերը կցվել են ՕՀԳ-ին կամ ՕՀ-ին');
                $event->sheet->getDelegate()->setCellValue('T3', 'նյութերը կցվել են այլ ահազանգի նյութերին');
                $event->sheet->getDelegate()->setCellValue('U3', 'նյութերը փոխանցվել են այլ ստորաբաժանում');
                $event->sheet->getDelegate()->setCellValue('V3', 'օբյեկտը մեկնել է ՀՀ-ից');
                $event->sheet->getDelegate()->setCellValue('W3', 'օբյեկտը հրաժարվել է հանցավոր մտադրությունից');
                $event->sheet->getDelegate()->setCellValue('X3', 'օբյեկտը հրաժարվել է թշնամական մտադրությունից');
                $event->sheet->getDelegate()->setCellValue('Y3', 'այլ պատճառներ');

                $event->sheet->getDelegate()->mergeCells('Z2:Z3')
                    ->setCellValue('Z2', 'Ահազանգը չի հաստատվել')
                    ->getStyle('Z2:Z3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()
                    ->mergeCells('AA1:AA3')
                    ->setCellValue('AA1', 'Ահազանգը փոխանցվել է այլ ստորաբաժանում')
                    ->getStyle('AA1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);


                $event->sheet->getDelegate()
                    ->mergeCells('AB1:AC2')
                    ->setCellValue('AB1', 'Ժամկետանց ահազանգեր')
                    ->getStyle('AB1:AC2')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle("AB3:AC3")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->setCellValue('AB3', sprintf('%s դրությամբ վարույթում գտնվող ժամկետանց ահազանգեր', $this->to));
                $event->sheet->getDelegate()->setCellValue('AC3', 'դադարեցված ժամկետանց ահազանգեր');

                $event->sheet->getDelegate()
                    ->mergeCells('AD1:AD3')
                    ->setCellValue('AD1', sprintf('%s դրությամբ վարույթում գտնվող ահազանգերը', $this->to))
                    ->getStyle('AD1:AD3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

            },
        ];

    }
}
