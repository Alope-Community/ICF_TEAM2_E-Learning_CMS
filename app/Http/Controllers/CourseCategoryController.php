<?php

namespace App\Http\Controllers;

use App\Models\CategoryCourse;
use App\MyClass\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseCategoryController extends Controller
{
    public function index(Request $request){
        if($request->ajax()) {
			return CategoryCourse::dataTable($request);
		}
        return view('category-course.index',[

        ]);
    }
    public function get($name){
        echo($name);
        DB::beginTransaction();
        try {
            $data = [];
            if(!$name) {
                $data += CategoryCourse::getAllData();
            } else{
                $data += CategoryCourse::where('name', $name);
            }

            return Response::success([
                'message' => 'Get data category success',
                'data' => $data,
                'code' => 200
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }
}
