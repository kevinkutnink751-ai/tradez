<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tp_Transaction;
use App\Models\User;
use App\Services\CourseService;
use App\Traits\PingServer;
use App\Traits\TemplateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    use PingServer, TemplateTrait;

    public function courses()
    {
        return view("user.membership.courses", [
            'title' => 'Courses',
        ]);
    }

 
public function courseDetails($course, $id)
{
    $data = CourseService::course((int)$id);

    abort_if(!$data, 404, 'Course not found');

    return view("user.membership.courseDetails", [
        'title'   => 'Course Details',
        'course'  => $data->course,
        'lessons' => $data->lessons,
    ]);
}

public function myCoursesDetails($id)
{
    $data = CourseService::course((int)$id);

    abort_if(!$data, 404, 'Course not found');

    return view("user.membership.mycourse-details", [
        'title'   => 'Course Details',
        'course'  => $data->course,
        'lessons' => $data->lessons,
    ]);
}

public function myCourses()
{
    $courses = CourseService::courses();

    return view("user.membership.my-course", [
        'title'   => 'My Courses',
        'courses' => $courses,
    ]);
}
    public function learning($lessonid, $courseid = null)
    {
        $context = CourseService::lessonWithContext($lessonid, $courseid);
           return view('user.membership.watchlesson', [
        'title'    => $context['lesson']?->title ?? 'Lesson',
        'lesson'   => $context['lesson'],
        'course'   => $context['course'],
        'previous' => $context['previous'],
        'next'     => $context['next'],
    ]);
    }

    public function buyCourse(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $response = $this->fetctApi('/course', [
            'courseId' => $request->course,
        ]);
        $info = json_decode($response);
        $course = $info->data->course;

        if ($course->amount) {
            $amount = $course->amount;
        } else {
            $amount = 0;
        }

        $responseUserCourse = $this->fetctApi('/user-course', [
            'courseId' => $request->course,
            'clientId' => $user->id
        ]);

        $useInfo = json_decode($responseUserCourse);
        $userCourse = $useInfo->data->course;

        if ($userCourse) {
            return redirect()->back()->with('message', 'You have already purchase this course, you can view it on my course page');
        }

        if ($user->account_bal < $amount) {
            return redirect()->back()->with('message', 'You have insufficient funds in your account balance to make this purchase, please make a deposit');
        }

        $user->account_bal = $user->account_bal - $amount;
        $user->save();

        $responseUserCourse = $this->fetctApi('/buy-course', [
            'courseId' => $request->course,
            'clientId' => $user->id
        ], 'POST');

        //create history
        Tp_Transaction::create([
            'user' => $user->id,
            'plan' => "Purchase Course",
            'amount' => $amount,
            'type' => "Education",
        ]);

        return redirect()->back()->with('success', $responseUserCourse['message']);
    }
}
