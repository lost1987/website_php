<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/5
     * Time: 上午10:47
     */

    namespace excelfactory;


    use core\Base;

    abstract class BaseExcelExport extends Base
    {

        protected $cellNamesChar = array(
            'A' , 'B' , 'C' , 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J' ,
            'K' , 'L' , 'M' , 'N' , 'O' , 'P' , 'Q' , 'R' , 'S' , 'T' ,
            'U' , 'V' , 'W' , 'X' , 'Y' , 'Z'
        );

        /**
         * 根据$data数据导出excel
         * @param $request
         */
        public function export( Array $request )
        {
            set_time_limit( 120 );
            list( $data , $columns_names , $columns_keys ) = $this->fetchData( $request );
            $excel = new \PHPExcel();
            $excel->getProperties()->setCreator( "newbee" );
            $excel->getProperties()->setLastModifiedBy( "newbee" );
            $excel->getProperties()->setTitle( "Office 2007 XLS Test Document" );
            $excel->getProperties()->setSubject( "Office 2007 XLS Test Document" );
            $excel->getProperties()->setDescription( "Test document for Office 2007 XLS, generated using PHP classes." );
            $excel->getProperties()->setKeywords( "office 2007 openxml php" );
            $excel->getProperties()->setCategory( 'data' );

            $excel->setActiveSheetIndex( 0 );
            $activeSheet = $excel->getActiveSheet();
            $activeSheet->setTitle( 'data' );

            $columns_num = count( $columns_names );

            //设置列名
            for ( $i = 0 ; $i < $columns_num ; $i ++ ) {
                $activeSheet->setCellValue( $this->cellNamesChar[ $i ] . '1' , $columns_names[ $i ] );
                $activeSheet->getStyle( $this->cellNamesChar[ $i ] . '1' )->getFill()->setFillType( \PHPExcel_Style_Fill::FILL_SOLID );
                $activeSheet->getStyle( $this->cellNamesChar[ $i ] . '1' )->getFill()->getStartColor()->setARGB( \PHPExcel_Style_Color::COLOR_GREEN );
                $activeSheet->getColumnDimension( $this->cellNamesChar[ $i ] )->setWidth( 30 );
                $activeSheet->getStyle( $this->cellNamesChar[ $i ] . '1' )->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
            }

            //设置值
            $rows = count( $data );
            if ( $rows > 0 ) {
                for ( $i = 0 ; $i < $rows ; $i ++ ) {
                    $index = $i + 2;
                    $object = $data[ $i ];

                    for ( $k = 0 ; $k < $columns_num ; $k ++ ) {
                        $activeSheet->setCellValue( $this->cellNamesChar[ $k ] . $index , $object[ $columns_keys[ $k ] ] );
                        //设置文字水平居中
                        $activeSheet->getStyle( $this->cellNamesChar[ $k ] . $index )->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
                    }
                }
            }

            // 设置页方向和规模
            $excel->getActiveSheet()->getPageSetup()->setOrientation( \PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
            $excel->getActiveSheet()->getPageSetup()->setPaperSize( \PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
            $excel->setActiveSheetIndex( 0 );
            $date = date( 'Y-m-d H:i:s' );

            /*2007*/
            header( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
            header( 'Content-Disposition: attachment;filename="' . $this->params['excel_name'] . '_' . $date . '.xlsx"' );
            header( 'Cache-Control: max-age=0' );
            $objWriter = \PHPExcel_IOFactory::createWriter( $excel , 'Excel2007' );
            $objWriter->save( 'php://output' );

            /**office 2003
             * header('Content-Type: application/vnd.ms-excel');
             * header('Content-Disposition: attachment;filename="'.$this->params['excel_name'].'_'.$date.'.xls"');
             * header('Cache-Control: max-age=0');
             * $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
             * $objWriter->save('php://output');
             **/
            exit;
        }
    }