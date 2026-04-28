<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\PingServer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\CourseService;
class MembershipController extends Controller
{
    use PingServer;
    //
   
public function showCourses(Request $request)
{
 
    return view('admin.memebership.courses', [
        'title'      => 'Courses',
        'courses'    => CourseService::courses(),
        'categories' => CourseService::categories(),
    ]);
}

public function addCourse(Request $request)
{
    if (empty($request->image_url) && !$request->hasFile('image')) {
        return redirect()->back()->with('message', 'Please choose a course image');
    }

    if ($request->hasFile('image')) {
        $this->validate($request, ['image' => 'image|mimes:jpg,jpeg,png|max:1000']);
        $path = $request->file('image')->store('uploads', 'public');
    } else {
        $path = $request->image_url;
    }

    $result = CourseService::addCourse([
        'title'       => $request->title,
        'amount'      => $request->amount,
        'image_url'   => $path,
        'paidCourses' => $request->amount != '',
        'category'    => $request->category,
        'desc'        => $request->desc,
    ]);

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function updateCourse(Request $request)
{
    if ($request->image_url == '' && !$request->hasFile('image')) {
        return redirect()->back()->with('message', 'Please choose a course image');
    }

    if ($request->hasFile('image')) {
        $this->validate($request, ['image' => 'image|mimes:jpg,jpeg,png|max:1000']);
        $path = $request->file('image')->store('uploads', 'public');
    } else {
        $path = $request->image_url;
    }

    $result = CourseService::updateCourse((int)$request->course_id, [
        'title'       => $request->title,
        'amount'      => $request->amount,
        'image_url'   => $path,
        'paidCourses' => $request->amount != '',
        'category'    => $request->category,
        'desc'        => $request->desc,
    ]);

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function deleteCourse($courseId)
{
    $result = CourseService::deleteCourse((int)$courseId);

    if ($result->success && isset($result->image_url)) {
        if (Storage::disk('public')->exists($result->image_url)) {
            Storage::disk('public')->delete($result->image_url);
        }
    }

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function showLessons($id)
{
    $data = CourseService::course((int)$id);

    return view('admin.memebership.lessons', [
        'title'   => 'Lessons',
        'course'  => $data?->course,
        'lessons' => $data?->lessons ?? collect(),
    ]);
}

public function addLesson(Request $request)
{
    if ($request->image_url == '' && !$request->hasFile('image')) {
        return redirect()->back()->with('message', 'Please choose a course image');
    }

    if ($request->hasFile('image')) {
        $this->validate($request, ['image' => 'image|mimes:jpg,jpeg,png|max:1000']);
        $path = $request->file('image')->store('uploads', 'public');
    } else {
        $path = $request->image_url;
    }

    $result = CourseService::addLesson((int)$request->course_id, [
        'title'     => $request->title,
        'length'    => $request->length,
        'videolink' => $request->videolink,
        'preview'   => $request->preview,
        'desc'      => $request->desc,
        'cat'       => $request->has('category') ? $request->category : null,
        'thumbnail' => $path,
    ]);

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function updateLesson(Request $request)
{
    if ($request->image_url == '' && !$request->hasFile('image')) {
        return redirect()->back()->with('message', 'Please choose a course image');
    }

    if ($request->hasFile('image')) {
        $this->validate($request, ['image' => 'image|mimes:jpg,jpeg,png|max:1000']);
        $path = $request->file('image')->store('uploads', 'public');
    } else {
        $path = $request->image_url;
    }

    $result = CourseService::updateLesson((int)$request->lesson_id, [
        'title'     => $request->title,
        'length'    => $request->length,
        'videolink' => $request->videolink,
        'preview'   => $request->preview,
        'desc'      => $request->desc,
        'cat'       => $request->has('category') ? $request->category : null,
        'thumbnail' => $path,
    ]);

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function deleteLesson($lessonId)
{
    $result = CourseService::deleteLesson((int)$lessonId);

    if ($result->success && isset($result->image_url)) {
        if (Storage::disk('public')->exists($result->image_url)) {
            Storage::disk('public')->delete($result->image_url);
        }
    }

    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function addCategory(Request $request)
{
    $result = CourseService::addCategory($request->category);
    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function deleteCategory($id)
{
    $result = CourseService::deleteCategory((int)$id);
    return back()->with($result->success ? 'success' : 'message', $result->message);
}

public function category()
{
    return view('admin.memebership.category', [
        'title'      => 'Course Category',
        'categories' => CourseService::categories(),
    ]);
}

public function lessonWithoutCourse(): View
{
    return view('admin.memebership.lessons-without', [
        'title'      => 'Lessons without courses',
        'lessons'    => CourseService::lessonsWithoutCourse(),
        'categories' => CourseService::categories(),
    ]);
}
}