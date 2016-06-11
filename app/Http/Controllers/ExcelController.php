<?php

namespace Scheduler\Http\Controllers;

use Illuminate\Http\Request;

use Scheduler\Http\Requests;
use Scheduler\Http\Controllers\Controller;

use Excel;
use stdClass;
use Scheduler\Division;
use Carbon\Carbon;

class ExcelController extends Controller
{

    public function export()
    {


      Excel::create('rkf_' . Carbon::now(), function($excel) {

      
        $excel->sheet('timeline', function($sheet) {          

          $sheet->setAllBorders('thin');



          $months = [];

          $mon = new stdClass();
          $mon->name = "June";
          $mon->days = [];
          for ($d = 1; $d <= 30; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);

          $mon = new stdClass();
          $mon->name = "July";
          $mon->days = [];
          for ($d = 1; $d <= 31; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);

          $mon = new stdClass();
          $mon->name = "August";
          $mon->days = [];
          for ($d = 1; $d <= 31; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);

          $mon = new stdClass();
          $mon->name = "September";
          $mon->days = [];
          for ($d = 1; $d <= 30; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);


          $mon = new stdClass();
          $mon->name = "October";
          $mon->days = [];
          for ($d = 1; $d <= 31; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);

          $mon = new stdClass();
          $mon->name = "November";
          $mon->days = [];
          for ($d = 1; $d <= 30; $d++){
            array_push($mon->days, $d);
          }
          array_push($months, $mon);


          $col = [];
          foreach (range('A','Z') as $c) {
            $sheet->setWidth($c, 3);            
            array_push($col, "$c");
          }
          foreach (range('A','Z') as $c) {
            foreach (range('A','Z') as $d) {
              $sheet->setWidth("$c$d", 3);
              array_push($col, "$c$d");
            }
          }
          $sheet->setWidth("B", 40);      


          $i = 1;
          $sheet->mergeCells("A1:B1");
          $sheet->mergeCells("C1:AF1");
          $sheet->mergeCells("AG1:BK1");
          $sheet->mergeCells("BL1:CP1");
          $sheet->mergeCells("CQ1:DT1");
          $sheet->mergeCells("DU1:EY1");
          $sheet->mergeCells("EZ1:GC1");

          $data = ['', ''];
          foreach($months as $mon) {
            foreach ($mon->days as $day) {
              array_push($data, $mon->name);
            }
          }
          $sheet->row($i++, $data);

          $mondaysJ = [];
          $j = 2;
          $data = ['Bidang', 'Bidang'];
          $dayname = ['Mo', 'Su', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
          $dayctr = 3;
          foreach($months as $mon) {
            foreach ($mon->days as $day) {
              array_push($data, $dayname[$dayctr++]);
              if($dayctr >= count($dayname)) {
                $dayctr = 0;
                array_push($mondaysJ, $j);
              }
              $j++;
            }
          }
          $sheet->row($i++, $data);

          $data = ['Bidang', 'Bidang'];
          $sheet->mergeCells("A2:B3");
          foreach($months as $mon) {
            foreach ($mon->days as $day) {
              array_push($data, $day);
            }
          }
          $sheet->row($i++, $data);

          $plenoJ = [];
          $rkfJ = [];
          $phpJ = [];

          foreach (Division::all() as $division) {
            $sheet->mergeCells("A$i:B$i");
            $sheet->cells("A$i:GC$i", function($cells) {
              $divisionColor  = '#009688';
              $cells->setBackground($divisionColor);
            });
            $sheet->row($i++, [$division->name]);
            $ctr = 1;

            foreach ($division->prokers as $proker) {

              $data = [$ctr++, $proker->name];             

              $m = 6;
              $start = Carbon::parse($proker->start_date);
              $end = Carbon::parse($proker->end_date);

              $j = 2;
              foreach($months as $mon) {
                foreach ($mon->days as $day) {

                  $curr = Carbon::parse('2016-' . $m . '-' . $day);

                  if ($curr->gte($start) && $curr->lte($end)) {
                    if (preg_match("/^pleno/i", $proker->name) || preg_match("/^rapat/i", $proker->name)) {
                      array_push($plenoJ, $j);
                    } else if (preg_match("/^rkf/i", $proker->name)) {
                      array_push($rkfJ, $j);
                    } else if (preg_match("/^php panitia/i", $proker->name)) {
                      array_push($phpJ, $j);
                    }
                  }

                  $sheet->cell($col[$j]. $i, function($cell) {
                    $cell->setBackground("#EEEEEE");
                  });                    

                  if (in_array($j, $mondaysJ)) {
                    $sheet->cell($col[$j]. $i, function($cell) {
                      $sundayColor    = '#2196F3';
                      $cell->setBackground($sundayColor);
                    });                    
                  }
                  if (in_array($j, $plenoJ)) {
                    $sheet->cell($col[$j]. $i, function($cell) {
                      $plenoColor     = '#CDDC39';
                      $cell->setBackground($plenoColor);
                    });                    
                  }
                  if (in_array($j, $phpJ)) {
                    $sheet->cell($col[$j]. $i, function($cell) {
                      $phpColor       = '#607D8B';
                      $cell->setBackground($phpColor);
                    });                    
                  }
                  if (in_array($j, $rkfJ)) {
                    $sheet->cell($col[$j]. $i, function($cell) {
                      $rkfColor       = '#F44336';
                      $cell->setBackground($rkfColor);
                    });                    
                  }

                  if ($curr->gte($start) && $curr->lte($end)) {
                    $sheet->cell($col[$j]. $i, function($cell) {
                      $deadlineColor  = '#FF5722';
                      $cell->setBackground($deadlineColor);
                    });                    
                  }

                  $j++;
                }
                $m++;
              }

              if (preg_match("/^pleno/i", $proker->name) || preg_match("/^rapat/i", $proker->name)) {
              } else if (preg_match("/^rkf/i", $proker->name)) {
              } else if (preg_match("/^php panitia/i", $proker->name)) {
              } else {
                $sheet->row($i++, $data);
              }

            }

          }


          $sheet->cells('A1:GC' . $i, function($cells) {
            $cells->setAlignment('center');
          });

          $sheet->cells('A1:GC3', function($cells) {
            $cells->setBackground('#4CAF50');
            $cells->setFontColor('#ffffff');
          });



        });





        $excel->sheet('proker', function($sheet) {          

          $sheet->setAllBorders('none');

          $sheet->setWidth('A', 3);
          $sheet->setWidth('B', 30);
          $sheet->setWidth('C', 15);
          $sheet->setWidth('D', 15);
          $sheet->setWidth('E', 40);

          $i = 1;

          $divisions = Division::all();

          foreach($divisions as $division) {

            $sheet->cells('A'.$i, function($cell) {
              $cell->setFontWeight('bold');
              $cell->setFontSize(16);
            });

            $sheet->row($i++, [$division->name]);

            $sheet->cells('A'.$i.':D'.$i, function($cells) {
              $cells->setBorder('solid', 'solid', 'solid', 'solid');
              $cells->setFontWeight('bold');
            });

            $sheet->row($i++, ['#', 'Proker', 'Tgl Mulai', 'Tgl Selesai', 'Deskripsi']);

            $j = 1;
            foreach ($division->prokers as $proker) {
              $sheet->row($i++, [$j++, $proker->name, $proker->start_date, $proker->end_date, $proker->description]);
            }

            $i++;

          }

        });


      })->download('xls');
    }

}
