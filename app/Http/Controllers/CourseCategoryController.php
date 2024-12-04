<?php

namespace App\Http\Controllers;

use App\Models\CategoryCourse;
use App\MyClass\Response;
use App\MyClass\Validations;
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
    public function create(Request $request){
        Validations::createDataCategory($request);
        DB::beginTransaction();
        try {
            CategoryCourse::createCategory($request->all());

            DB::commit();
            return Response::success([
                'message' => 'Data Berhasil Di buat'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function edit(CategoryCourse $categoryCourse){
        DB::beginTransaction();
        try{
            return Response::success([
                'category' => $categoryCourse
            ]);
        } catch (Exception $e){
            return Response::error($e);
        }
    }

    public function update(Request $request, CategoryCourse $categoryCourse){
        DB::beginTransaction();
        try {
            $categoryCourse->editCategory($request->all());

            DB::commit();
            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(CategoryCourse $categoryCourse){
        DB::beginTransaction();
        try {
            $categoryCourse->deleteCategory();

            DB::commit();
            return Response::success([
                'message' => 'Data telah di hapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }

    /**
     * Api
     */
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
