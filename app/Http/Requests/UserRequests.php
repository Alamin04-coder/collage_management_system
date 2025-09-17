<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class UserRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $form = $this->input('form_type');
        switch ($form) {
            case "course":
                return [

                    'course_name' => 'required|max:100',
                    'course_fee' => 'required|max:8',
                    'course_time' => 'required',
                    'course_code' => 'required',
                    'description' => 'required',
                    'teacher_id' => 'required',

                ];
                break;

            case "teacher":

                $id = $this->route('id');
                $teachers_id = $id ? 'required|max:6|unique:teachers,teacher_id,' . $id :
                    'required|max:6|unique:teachers,teacher_id';
                return [
                    'name' => 'required|string|max:255',
                    'teacher_id' => $teachers_id,
                    'phone' => 'required|string|max:15',
                    'gender' => 'required|string|max:10',
                    'dob' => 'required|date',
                    'department' => 'required|string|max:255',
                    'specialization' => 'required|string|max:255',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                    'join_date' => 'required|date',
                    'address' => 'required|string|max:255',

                ];

                break;
                case "student" :

                    $id = $this->route('id');
                    $class_roll = $id ? 'required|string|max:255|unique:students,class_roll,' . $id
                    :'required|string|max:255|unique:students,class_roll';

                    $board_roll = $id ? 'required|string|max:255|unique:students,board_roll,' . $id
                    :'required|string|max:255|unique:students,board_roll';

                    $reg_no = $id ?  'required|string|max:255|unique:students,registration_no,' . $id
                    : 'required|string|max:255|unique:students,registration_no';


                    return[
                        'name' => 'required|string|max:255',
                        'session' => 'required|string|max:255',
                        'department' => 'required|string|max:255',
                        'class_roll' => $class_roll,
                        'board_roll' => $board_roll ,
                        'registration_no' => $reg_no,
                        'shift' => 'required|string|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                    ];
                    break;

                    case "course_enroll":

                        return[

                            'teacher_id' =>'required|max:3',
                            'course_id'=>'required|max:6',
                            'student_id'=>'required|max:4',
                            'email' =>'required|email',
                            'phone' =>'required',

                        ];

                    case 'notice':
                        return[
                            'title' => 'required|max:225|string',
                            'description'=> 'required|max:500|string',
                            
                        ];


                    default:
                        return [];
        }
    }
}
