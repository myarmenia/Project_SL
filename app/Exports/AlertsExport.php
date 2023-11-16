<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;

class AlertsExport implements FromArray, WithEvents
{

    public int $columns_count = 31;
    public array $headers = [];
    public string $doc_title;

    public int $total_row_count = 0;

    public function __construct()
    {
        $this->headers = [
            'ՀՀ ԱԱԾ ստորաբաժանումը',
            'Количество агентуры',
            '-----(A-1 օր)------ դրությամբ վարույթում գտնվող ահազանգերը',
            'Գրանցվել է',
            'ընդամենը -----A-----  -  ------B------',
            'Տեղեկության աղբյուրը',
            'X',
            'Y',
            'Z',
            'Ահազանգը ստացվել է այլ ստորաբաժանումից',
            'Ահազանգի ստուգումը դադարեցվել է',
            'ընդամենը -----A-----  -  ------B------',
            'Ահազանգը հաստատվել է',
            'հարուցվել է քրեական գործ',
            'գրանցվել է ՕՀԳ կամ ՕՀ',
            'հայտարարվել է պաշտոնական նախազգուշացում',
            'անցկացվել է կանխարգելիչ միջոցառում',
            'զենքի և ռազմամթերքի կամավոր հանձնում',
            'օբյեկտը կրել է վարչական տույժ',
            'նյութերը փոխանցվել են ՔՎ',
            'նյութերը փոխանցվել են ՀՀ ոստիկանություն, դատախազություն',
            'տեղեկացվել են շահագրգիռ պետական այլ մարմիններ',
            'իրականացվել են այլ միջոցառումներ',
            'Ստուգումը դադարեցվել է',
            'նյութերը կցվել են ՕՀԳ-ին կամ ՕՀ-ին',
            'նյութերը կցվել են այլ ահազանգի նյութերին',
            'նյութերը փոխանցվել են այլ ստորաբաժանում',
            'օբյեկտը մեկնել է ՀՀ-ից',
            'օբյեկտը հրաժարվել է հանցավոր մտադրությունից',
            'օբյեկտը հրաժարվել է թշնամական մտադրությունից',
            'այլ պատճառներ',
            'Ահազանգը չի հաստատվել',
            'Ահազանգը փոխանցվել է այլ ստորաբաժանում',
            'Ժամկետանց ահազանգեր',
            '------B----- դրությամբ վարույթում գտնվող ժամկետանց ահազանգեր',
            'դադարեցված ժամկետանց ահազանգեր',
            '-----B------ դրությամբ վարույթում գտնվող ահազանգերը',
        ];
        $this->doc_title = 'Տեղեկություն
--------A--------  -  -------B------- ժամանակահատվածում ՀՀ ԱԱԾ օպերատիվ ստորաբաժանումների կողմից
ահազանգերով տարվող աշխատանքների և դրանց արդյունքների վերաբերյալ';
    }

    public function array(): array
    {
        $test = [];
        for ($i = 0; $i < 10; $i++) {
            $test[] = [
                'name_' . $i => sprintf('%s-ին ստորաբաժ', $i),
                'value_' . $i => (string)$i,
                'value2_' . $i => (string)($i + 4)
            ];
        }


        $this->total_row_count = count($test) + 2;

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
            $test,
            $totals
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $headersRange = 'A1:AE3';

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

                $event->sheet->getDelegate()->getStyle('A1:AE' . $this->total_row_count + 2)->applyFromArray([
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
                    ->getStyle('A4:A' . $this->total_row_count)
                    ->getFont()
                    ->setSize(9)
                    ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->setCellValue('B1', 'Количество агентуры');

                $event->sheet->getDelegate()->getStyle("B1:C1")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);


                $event->sheet->getDelegate()->mergeCells('A1:A3');
                $event->sheet->getDelegate()->mergeCells('B1:B3');
                $event->sheet->getDelegate()->mergeCells('C1:C3');

                $event->sheet->getDelegate()->setCellValue('C1', '-----(A-1 օր)------ դրությամբ վարույթում գտնվող ահազանգերը');
                $event->sheet->getDelegate()->mergeCells('D1:G1')->setCellValue('D1', 'Գրանցվել է');
                $event->sheet->getDelegate()->mergeCells('D2:D3')->setCellValue('D2', 'ընդամենը -----A-----  -  ------B------');

                $event->sheet->getDelegate()->getStyle("D2:D3")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->mergeCells('E2:G2')
                    ->setCellValue('E2', 'Տեղեկության աղբյուրը')
                    ->getStyle("E2:G2")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle("E3:G3")
                    ->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true);

                $event->sheet->getDelegate()->setCellValue('E3', 'X');
                $event->sheet->getDelegate()->setCellValue('F3', 'Y');
                $event->sheet->getDelegate()->setCellValue('G3', 'Z');

                $event->sheet->getDelegate()->mergeCells('H1:H3')
                    ->setCellValue('H1', 'Ահազանգը ստացվել է այլ ստորաբաժանումից')
                    ->getStyle('H1:H3')
                    ->getAlignment()
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->mergeCells('I1:AA1')->setCellValue('I1', 'Ահազանգի ստուգումը դադարեցվել է');
                $event->sheet->getDelegate()->mergeCells('I2:I3')
                    ->setCellValue('I2', 'ընդամենը -----A-----  -  ------B------')
                    ->getStyle('I2:I3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->mergeCells('J2:S2')->setCellValue('J2', 'Ահազանգը հաստատվել է');

                $event->sheet->getDelegate()
                    ->getStyle("J3:Z3")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->setCellValue('J3', 'հարուցվել է քրեական գործ');
                $event->sheet->getDelegate()->setCellValue('K3', 'գրանցվել է ՕՀԳ կամ ՕՀ');
                $event->sheet->getDelegate()->setCellValue('L3', 'հայտարարվել է պաշտոնական նախազգուշացում');
                $event->sheet->getDelegate()->setCellValue('M3', 'անցկացվել է կանխարգելիչ միջոցառում');
                $event->sheet->getDelegate()->setCellValue('N3', 'զենքի և ռազմամթերքի կամավոր հանձնում');
                $event->sheet->getDelegate()->setCellValue('O3', 'օբյեկտը կրել է վարչական տույժ');
                $event->sheet->getDelegate()->setCellValue('P3', 'նյութերը փոխանցվել են ՔՎ');
                $event->sheet->getDelegate()->setCellValue('Q3', 'նյութերը փոխանցվել են ՀՀ ոստիկանություն, դատախազություն');
                $event->sheet->getDelegate()->setCellValue('R3', 'տեղեկացվել են շահագրգիռ պետական այլ մարմիններ');
                $event->sheet->getDelegate()->setCellValue('S3', 'իրականացվել են այլ միջոցառումներ');

                $event->sheet->getDelegate()->mergeCells('T2:Z2')->setCellValue('T2', 'Ստուգումը դադարեցվել է');

                $event->sheet->getDelegate()->setCellValue('T3', 'նյութերը կցվել են ՕՀԳ-ին կամ ՕՀ-ին');
                $event->sheet->getDelegate()->setCellValue('U3', 'նյութերը կցվել են այլ ահազանգի նյութերին');
                $event->sheet->getDelegate()->setCellValue('V3', 'նյութերը փոխանցվել են այլ ստորաբաժանում');
                $event->sheet->getDelegate()->setCellValue('W3', 'օբյեկտը մեկնել է ՀՀ-ից');
                $event->sheet->getDelegate()->setCellValue('X3', 'օբյեկտը հրաժարվել է հանցավոր մտադրությունից');
                $event->sheet->getDelegate()->setCellValue('Y3', 'օբյեկտը հրաժարվել է թշնամական մտադրությունից');
                $event->sheet->getDelegate()->setCellValue('Z3', 'այլ պատճառներ');

                $event->sheet->getDelegate()->mergeCells('AA2:AA3')
                    ->setCellValue('AA2', 'Ահազանգը չի հաստատվել')
                    ->getStyle('AA2:AA3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()
                    ->mergeCells('AB1:AB3')
                    ->setCellValue('AB1', 'Ահազանգը փոխանցվել է այլ ստորաբաժանում')
                    ->getStyle('AB1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);


                $event->sheet->getDelegate()
                    ->mergeCells('AC1:AD2')
                    ->setCellValue('AC1', 'Ժամկետանց ահազանգեր')
                    ->getStyle('AC1:AD2')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle("AC3:AD3")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

                $event->sheet->getDelegate()->setCellValue('AC3', ' ------B----- դրությամբ վարույթում գտնվող ժամկետանց ահազանգեր');
                $event->sheet->getDelegate()->setCellValue('AD3', 'դադարեցված ժամկետանց ահազանգեր');

                $event->sheet->getDelegate()
                    ->mergeCells('AE1:AE3')
                    ->setCellValue('AE1', '-----B------ դրությամբ վարույթում գտնվող ահազանգերը')
                    ->getStyle('AE1:AE3')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('bottom')
                    ->setWrapText(true)
                    ->setTextRotation(90);

            },
        ];

    }
}
