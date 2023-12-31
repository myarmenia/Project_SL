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

class QualificationExport implements FromArray, WithEvents
{

    public int $columns_count;
    public array $headers = [];
    public string $doc_title;
    private string $from;
    private string $to;
    private array $titles = [];
    private array $values = [];
    public int $total_row_count = 0;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->doc_title = sprintf('Տեղեկություն %s - %s ժամանակահատվածում ՀՀ ԱԱԾ օպերատիվ ստորաբաժանումների կողմից գրանցված ահազանգների երանգավորումների վերաբերյալ', Carbon::createFromFormat('Y-m-d', $from)->format('d-m-Y'), Carbon::createFromFormat('Y-m-d', $to)->format('d-m-Y'));
    }

    public function array(): array
    {
        $agencies_with_root_parent = Report::getAgenciesWithRoot();
        $data = Report::getQualified($this->from, $this->to);
        $exists = [];
        foreach ($data as $datum) {
            $agency_id = isset($agencies_with_root_parent[$datum->agency_id]) ? $agencies_with_root_parent[$datum->agency_id]->parent_id : $datum->agency_id;
            $this->titles[$datum->qualification_id] = $datum->qualification_name;
            if (isset($exists[$agency_id][$datum->qualification_id])) {
                $exists[$agency_id][$datum->qualification_id] += $datum->total;
            } else {
                $exists[$agency_id][$datum->qualification_id] = $datum->total;
            }
        }

        $empty = array_fill_keys(array_keys($this->titles), '');

        foreach ($data as $datum) {
            $agency_id = isset($agencies_with_root_parent[$datum->agency_id]) ? $agencies_with_root_parent[$datum->agency_id]->parent_id : $datum->agency_id;
            $agency_name = isset($agencies_with_root_parent[$datum->agency_id]) ? $agencies_with_root_parent[$datum->agency_id]->name : $datum->opened_subunit;
            $this->values[$agency_id]['opened_subunit'] = $datum->opened_subunit;
            $this->values[$agency_id] = array_replace($empty, $exists[$agency_id]);
            array_unshift($this->values[$agency_id], $agency_name);
        }

        $this->values = $this->sortByConfig($this->values);

        $this->total_row_count = count($this->values) + 2;
        $this->columns_count = count($this->titles);

        $totals = ['ԸՆԴԱՄԵՆԸ'];

        for ($j = 2; $j <= $this->columns_count + 1; $j++) {
            $col = Coordinate::stringFromColumnIndex($j);
            $r_index = $this->total_row_count;
            $r_index++;
            $col_range = sprintf('SUM(%s4:%s%d)', $col, $col, $r_index);
            $func = sprintf('=IF(%s<>0,%s,"")', $col_range, $col_range);

            $totals[] = $func;
        }

        return [
            [''],
            [''],
            [''],
            $this->values,
            $totals
        ];
    }

    /**
     * @param array $values
     * @return array
     *
     * Sorts the array by given identifiers,
     * elements not found in the config
     * are added to the end of the array in descending order
     */
    private function sortByConfig(array $values): array
    {
        $result = $exists_in_order = [];
        $order = config('report.agency_id_order', []);
        $others = [];
        foreach ($values as $id => $value) {
            if (in_array($id, $order)) {
                $exists_in_order[$id] = $value;
            } else {
                $others[$id] = $value;
            }
        }
        unset($values);

        if ($exists_in_order) {
            uksort($exists_in_order, function ($key1, $key2) use ($order) {
                return (array_search($key1, $order) > array_search($key2, $order));
            });
            $result += $exists_in_order;
        }

        if ($others) {
            krsort($others);
            $result = $result + $others;
        }

        return $result;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $headersRange = 'A1:AB3';

                $event->sheet->getHeaderFooter()->setDifferentOddEven(false);

//                $event->sheet->getSheetView()->setView(SheetView::SHEETVIEW_PAGE_LAYOUT);
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


                $headers->getFont()
                    ->setSize(8)
                    ->setName('Times Armenian');

                $headers->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center');

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

                $event->sheet->getDelegate()
                    ->mergeCells('A1:A3')
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);


                if ($this->titles) {
                    $titles = $this->titles;
                    $_index = 0;
                    $setAutoSize = count($titles) > 8;
                    foreach ($titles as $id => $title) {
                        $start = $_index;
                        $dynamic_col = Coordinate::stringFromColumnIndex($start + 2);
                        if ($setAutoSize) {
                            $event->sheet->getDelegate()->getColumnDimension($dynamic_col)->setAutoSize(true);
                        } else {
                            $event->sheet->getDelegate()->getColumnDimension($dynamic_col)->setWidth(5);
                        }

                        $title_col = sprintf("%s%d", $dynamic_col, 2);
                        $id_col = sprintf("%s%d", $dynamic_col, 3);

                        $event->sheet->getDelegate()
                            ->setCellValue($title_col, $title)
                            ->getStyle($title_col)
                            ->getAlignment()
                            ->setTextRotation(90)
                            ->setHorizontal('center')
                            ->setVertical('bottom')
                            ->setWrapText(true);


                        $colum_id = $event->sheet->getDelegate()
                            ->setCellValue($id_col, $id)
                            ->getStyle($id_col);

                        $colum_id->getAlignment()
                            ->setHorizontal('center')
                            ->setVertical('center')
                            ->setWrapText(true);

                        $colum_id->getFont()->setSize(10)->setBold(true);
                        $_index++;
                    }
                }

                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(60);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(90);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(40);

                $glob_title_col = Coordinate::stringFromColumnIndex($this->columns_count + 1);
                $event->sheet->getDelegate()
                    ->mergeCells(sprintf('B1:%s1', $glob_title_col))
                    ->setCellValue('B1', 'Ահազանգերի երանգավորումները և դրանց հերթական համարները')
                    ->getStyle('B1')
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $vertical_total = Coordinate::stringFromColumnIndex($this->columns_count + 2);
                $vertical_total_cols = sprintf("%s1:%s3", $vertical_total, $vertical_total);

                for ($j = 0; $j < $this->total_row_count - 1; $j++) {
                    $index = $j + 4;
                    $vertical_total_values = sprintf("%s%d", $vertical_total, $index);

                    $col_range = sprintf('SUM(B%d:%s%d)', $index, $glob_title_col, $index);
                    $func = sprintf('=IF(%s<>0,%s,"")', $col_range, $col_range);
                    $event->sheet->getDelegate()->setCellValue($vertical_total_values, $func);
                }

                $vertical_total_col = $event->sheet->getDelegate()
                    ->mergeCells($vertical_total_cols)
                    ->setCellValue(sprintf("%s1", $vertical_total), 'ԸՆԴԱՄԵՆԸ')
                    ->getStyle(sprintf("%s1", $vertical_total));

                $vertical_total_col->getFont()
                    ->setSize(8)
                    ->setBold(true);

                $vertical_total_col->getAlignment()
                    ->setTextRotation(90)
                    ->setHorizontal('center')
                    ->setVertical('center')
                    ->setWrapText(true);

                $last_bottom_col = sprintf("A1:%s%d", $vertical_total, $this->total_row_count + 2);
                $event->sheet->getDelegate()->getStyle($last_bottom_col)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_DOUBLE,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
