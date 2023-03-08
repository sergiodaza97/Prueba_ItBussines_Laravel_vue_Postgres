<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Sp;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Hotel;
class HotelController extends Controller
{
    use Sp;
    public function getHotel(Request $request){

        $status = false;
        $response = [];
        $data = [];
        $count = 0;
        $offset = $request->limit * ($request->page - 1);
        $search = $request->search;
        $data_db = [];
        try {
            //Trae los registros, en caso que se genere busqueda entra al else y trae los registros con el parametro indicadp, se agrega limit y offset para paginado de tabla
            if($search == null){
                $result = DB::table('hotel')
                                    ->offset($offset)
                                    ->limit($request->limit)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }else{
                $result = DB::table('hotel')
                                    ->where('name', 'LIKE', '%'.$search.'%')
                                    ->offset($offset)
                                    ->limit($request->limit)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }
            //V-server necesita un contador
            $count = count($result);
            $data_db = $result->all();
            if($count > 0){
                $status = true;
                $response = [
                    'type' => "success",
                    'content' => "Hoteles consultados correctamente."
                ];
                //Ingresamos typo y acomodacion de habitaciones por hotel, las agregamos al arreglo
                $responseData = [];
                    $responseData = array_map(function ($item) {
                        $db = DB::table('accomodation')->where('id_hotel', $item->id)->get();
                        $item->bedroom = $db->all();
                        return $item;
                    }, $data_db);
                $data = $responseData;
            }else{
                $response = [
                    'type' => "error",
                    'content' => "Hubo un error al consultar los hoteles."
                ]; 
            }
            return response()->json([
                'status' => $status,
                'count' => $count,
                'response' => $response,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            // dd($th);
        }
    }

    public function saveHotel(Request $request){

        $status = false;
        $response = [];
        $date = Carbon::now()->toDateTimeString();
        try {
            //Se genera el insert para la creacion del hotel
            $result = DB::insert("INSERT INTO Hotel (name, city, address, nit, num_room, created_at, updated_at) VALUES ('$request->name', '$request->city', '$request->address', '$request->nit', '$request->num_room', '$date', '$date');");
            if($result){
                $status = true;
                $response = [
                    'type' => "success",
                    'content' => "Hoteles consultados correctamente."
                ];
            }else{
                $response = [
                    'type' => "error",
                    'content' => "Hubo un error al consultar los hoteles."
                ]; 
            }
            return response()->json([
                'status' => $status,
                'response' => $response
            ]);
        } catch (\Throwable $th) {
            //return null;
        }
    }

    public function getComplements(){
        //Datos complementarios que se necesetan en la vita o en los componentes
        $result = DB::select("SELECT * FROM hotel");
        $bedroom = [
            'ESTANDAR',
            'JUNIOR',
            'SUITE'
        ];
        $acomoding = [
            'Sencilla',
            'Doble',
            'Triple',
            'Quadruple'
        ];
        try {
            $data = [
                $bedroom,
                $acomoding,
                $result
            ];
            return response()->json($data);
        } catch (\Throwable $th) {
            //return null;
        }
    }

    public function acomodingBedroom(Request $request){
        $status = false;
        $response = [];
        $date = Carbon::now()->toDateTimeString();
        try {
            //Se eliminan registros para no sobreescribirlos
            $deleted_accomodation = DB::table('accomodation')->where('id_hotel', $request->id_room)->delete();
            //se agrega registro a registrp ya que son varios tipos y acomodaciones
            foreach($request->bedroom as $key){
                $num_bedrooms = $key['num_bedrooms'];
                $type_room = $key['type_room'];
                $accomodation = $key['accomodation'];
                $id = $request->id_room;
                $result = DB::insert("INSERT INTO accomodation (num_bedrooms, type_room, accomodation, id_hotel, created_at, updated_at) VALUES ('$num_bedrooms', '$type_room', '$accomodation', '$id', '$date', '$date');");
            }
            if($result){
                $status = true;
                $response = [
                    'type' => "success",
                    'content' => "Se guardo correctamente la acomodacion y tipo de habitaciones."
                ];
            }else{
                $response = [
                    'type' => "error",
                    'content' => "Hubo un error al consultar los hoteles."
                ]; 
            }
            return response()->json([
                'status' => $status,
                'response' => $response
            ]);
        } catch (\Throwable $th) {
            //return null;
        }
    }

    public function deleteHotel(Request $request){
        $status = false;
        $response = [];

        try {
            //A partir del id generamos el borrado de base primero en la tabla de acomodaciones, luego en la de hotel
            $deleted_accomodation = DB::table('accomodation')->where('id_hotel', $request->id)->delete();

            
            if($deleted_accomodation >= null){
                $deleted = DB::table('hotel')->where('id', $request->id)->delete();
                if ($deleted > 0) {
                    $status = true;
                    $response = [
                        'type' => "success",
                        'content' => "Se guardo correctamente la acomodacion y tipo de habitaciones."
                    ];
                }
            }else{
                $response = [
                    'type' => "error",
                    'content' => "Hubo un error al celiminar el hotel."
                ]; 
            }
            return response()->json([
                'status' => $status,
                'response' => $response
            ]);
        } catch (\Throwable $th) {
            //return null;
        }
    }
}
