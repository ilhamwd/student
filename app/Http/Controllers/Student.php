<?php

namespace App\Http\Controllers;

use App\Models\MStudent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class Student extends Controller
{
    /**
     * Default response for API consistency
     * 
     * @param array $data The data or payload that will be served to UI
     * @param string $message The message to be delivered
     * @param int $status The http response code
     */
    static function createAPIResponse(Array $data = [], string $message = "success", $status = 200) {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return Response::json($response, $status);
    }

    /**
     * Get all students.
     * No inputs are required.
     */
    public function getAllStudents() {
        $data = MStudent::all()->toArray();

        return Student::createAPIResponse($data);
    }

    /**
     * Data manipulation
     * Reuseable for insert and 
     * Requires validation to prevent duplication on nim
     * POST inputs are required as follows
     * 1. name
     * 2. nim
     * 3. birthday
     * 4. action (insert or update)
     */
    public function manipulation() {
        [$name, $nim, $birthday, $action] = array_map(function($inputValue) {
            return Request::post($inputValue);
        }, ['name', 'nim', 'birthday', 'action']);

        // Check whether the nim is already used
        $nimCheck = MStudent::where('nim', '=', $nim)->first();
        if($nimCheck && $action == 'insert') return Student::createAPIResponse([], 'NIM already exists', 409);

        $temporaryInstance = new MStudent;
        
        $temporaryInstance->name = $name;
        $temporaryInstance->nim = $nim;
        $temporaryInstance->birthday = $birthday;

        $temporaryInstance->save();

        return Student::createAPIResponse($temporaryInstance->toArray());
    }

    /**
     * Delete specific student by their ID
     * student_id is required as POST input
     */
    public function deleteStudent() {
        $studentID = Request::post('student_id');

        // Find the corresponding ID
        // Continue deletion if found
        // otherwise return 404 response
        $data = MStudent::find($studentID);
        if(!$data) return Student::createAPIResponse([], "The corresponding student's ID cannot be found", 404);

        MStudent::where('student_id', '=', $studentID)->delete();
    }
}
