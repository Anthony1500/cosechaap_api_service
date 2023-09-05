<?php

namespace App\Http\Controllers;

use App\Models\Fumigacione;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\DB;
use PHPExcel;
use PHPExcel_Chart_DataSeriesValues;
use PHPExcel_IOFactory;
use PHPExcel_Style;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Worksheet_MemoryDrawing;
class fumigacioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $fumigaciones=Fumigacione::all();
    return $fumigaciones;
    }
    public function selectfumigacionactual()
    {
    return view('selectfumigacionactual');
    }
    public function reportefumigacion()
    {
require_once "controlador/conexion.php";
$con =mysqli_connect($hostname,$username,$password,$database);
require_once 'controlador/excel.php';

require_once 'Classes/PHPExcel.php';
require_once 'controlador/mostrar.php';
$sql = "SELECT * FROM fumigaciones";
$resultado = mysqli_query($con,$sql);
$fila = 7; //Establecemos en que fila inciara a imprimir los datos
$gdImage = imagecreatefrompng('imagenes/imagendefault.png');
$gdImage1 = imagecreatefrompng('imagenes/info_corp_cosecha.png');
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Anthony")->setDescription("Reporte fumigaciones.");
	
	//Establecemos la pesta単a activa y nombre a la pesta単a
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("FUMIGACIONES");
	
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(100);
	$objDrawing->setCoordinates('B1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage1);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(100);
	$objDrawing->setCoordinates('G1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	$estiloTituloReporte = array(
		'font' => array(
		'name'      => 'Arial',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>13
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
		),
		'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		
		$estiloTituloColumnas = array(
		'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => 'FFFFFF'
		)
		),
		'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '538DD5')
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);
		
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray( array(
		'font' => array(
		'name'  => 'Arial',
		'color' => array(
		'rgb' => '000000'
		)
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
		),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		));
		
		$objPHPExcel->getActiveSheet()->getStyle('B1:G5')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('B6:G6')->applyFromArray($estiloTituloColumnas);
		
		$objPHPExcel->getActiveSheet()->setCellValue('E3', 'REPORTE DE LAS FUMIGACIONES');
		$objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->setCellValue('B6', 'ID');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('C6', 'FECHA');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('D6', 'HORA');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('E6', 'INVERNADERO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('F6', 'TRATAMIENTO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('G6', 'ENCARGADO');
		


$i = 2;
while($rows = $resultado->fetch_assoc())
{
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('B'.$fila, $rows['id'])
->setCellValue('C'.$fila, $rows['fecha'])
->setCellValue('D'.$fila, $rows['hora'])
->setCellValue('E'.$fila, $rows['invernadero'])
->setCellValue('F'.$fila, $rows['tratamiento'])
->setCellValue('G'.$fila, $rows['encargado']);

$fila++; //Sumamos 1 para pasar a la siguiente fila
}
$fila = $fila-1;
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B7:G".$fila);
	
	$filaGrafica = $fila+2;
	// definir origen de los valores
	$values = new PHPExcel_Chart_DataSeriesValues('Number', 'Fumigación!$D$7:$D$'.$fila);
	
	// definir origen de los rotulos
	$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Fumigación!$B$7:$B$'.$fila);
	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);



$objPHPExcel->getActiveSheet()->setTitle('Fumigación');

$objPHPExcel->setActiveSheetIndex(0);



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


$filename = "Reporte-Fumigación.xlsx";
$objWriter->save(storage_path("app/{$filename}"));


 return response()->download(storage_path("app/{$filename}"))->deleteFileAfterSend(true);
       
    }
    public function agregar(){
    return "hola";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregarfumigacion(Request $request)
    {
             $validateData = $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'invernadero' => 'required',
            'tratamiento' => 'required',
            'encargado' => 'required',
            'invernadero' => 'required'

        ]);

        $fumigacion = Fumigacione::insert($validateData);
        if ($fumigacion) {
            return response()->json(['message' => 'Datos guardados exitosamente'], 200);
        } else {
            return response()->json(['error' => 'Ha ocurrido un error al guardar los datos'], 500);
        }
    }
    public function editarfumigacion(Request $request)
    {
  $validateData = $request->validate([
        'fecha' => 'required',
        'hora' => 'required',
        'invernadero' => 'required',
        'tratamiento' => 'required',
        'encargado' => 'required',
        'invernadero' => 'required',
    ]);

 
    try {
     
        Fumigacione::updateFumigacion($request->input('id'), $validateData);
        } catch (\Throwable $th) {
        return response()->json(['error' => 'La fumigación no se guardo'], 422);
        }
        return response()->json(['success' => 'La fumigación se actualizó con éxito'], 200);
  
   

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selectfumigacioneditar(Request $request)
    {
       if (!$request->input('id')) {
            return response()->json(['error' => 'Campo requerido'], 422);
        }
    // Esta línea busca una fumigacion en la base de datos según el id especificado.
    $fumigacion = Fumigacione::where('id',$request->id)->firstOrFail();

    // Esta línea comprueba si fumigacion existe. Si no existe, devuelve un código de error 404.
     if (!$fumigacion) {
    return response()->json(['error' => 'fumigacion no encontrado'], 404);
    }

    
    return response()->json($fumigacion, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarfumigacion(Request $request)
    {
       
    
    try {
     
       DB::table('fumigaciones')->where('id', $request->input('id'))->delete();
        } catch (\Throwable $th) {
        return response()->json(['error' => 'La fumigación no se elimino'], 422);
        }
        return response()->json(['success' => 'La fumigación se elimino'], 200);
  
    
    
    
    }
}
