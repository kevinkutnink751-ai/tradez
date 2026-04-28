<?php

namespace App\Http\Livewire\User;

use App\Services\CourseService;
use Livewire\Component;
use Livewire\WithPagination;

class SystemCourses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $categories = [];
    public $courses = [];
    public $lessons;
    public $category = 'Artificial Intelligcence';
    protected $queryString = ['search'];

    public function mount()
    {
        // $responseCat = $this->fetctApi('/categories');
        // $responseCourses = $this->fetctApi('/courses');
        // $cat = json_decode($responseCat);
        // $cour = json_decode($responseCourses);
       

        // also needed for currency symbol
        $settings = (object) [
            'currency' => '₦',
        ];
         $courses    = CourseService::courses();
         $categories = CourseService::categories();

        $this->courses = $courses;
        $this->categories = $categories;
    }

    public function render()
    {
        return view('livewire.user.system-courses');
    }

    public function changeCategory($cat)
    {
        $this->category = $cat == 'others' ? null : $cat;
    }
}
