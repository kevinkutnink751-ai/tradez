<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CourseService
{
    protected static function load(): array
    {
        return require resource_path('content/fragments/courses.php');
    }

    // -----------------------------------------------
    // Read methods (existing — unchanged)
    // -----------------------------------------------

    public static function courses(): \Illuminate\Support\Collection
    {
        return collect(static::load()['courses'])->map(fn($item) => static::mapCourse($item));
    }

    public static function course(int $id): ?object
    {
        $course = collect(static::load()['courses'])
            ->firstWhere('course.id', $id);

        return $course ? static::mapCourse($course) : null;
    }

    public static function categories(): \Illuminate\Support\Collection
    {
        return collect(static::load()['categories'])->map(fn($item) => static::mapCategory($item));
    }

    public static function category(string $name): ?object
    {
        $category = collect(static::load()['categories'])
            ->firstWhere('category.category', $name);

        return $category ? static::mapCategory($category) : null;
    }

    public static function lesson(int $lessonId): ?object
    {
        foreach (static::load()['courses'] as $item) {
            foreach ($item['lessons'] as $lesson) {
                if ($lesson['id'] === $lessonId) {
                    return (object)$lesson;
                }
            }
        }
        return null;
    }

    public static function lessonWithContext(int $lessonId, ?int $courseId = null): array
    {
        $courseData = collect(static::load()['courses'])
            ->firstWhere('course.id', $courseId);

        if (!$courseData) {
            return [
                'lesson'   => static::lesson($lessonId),
                'course'   => null,
                'previous' => null,
                'next'     => null,
            ];
        }

        $lessons = collect($courseData['lessons'])->sortBy('order')->values();
        $index   = $lessons->search(fn($l) => $l['id'] === $lessonId);
        $lesson  = $index !== false ? (object)$lessons[$index] : null;

        return [
            'lesson'   => $lesson,
            'course'   => (object)$courseData['course'],
            'previous' => $index > 0 ? $lessons[$index - 1]['id'] : null,
            'next'     => $index !== false && $index < $lessons->count() - 1
                            ? $lessons[$index + 1]['id']
                            : null,
        ];
    }

    public static function lessonsWithoutCourse(): \Illuminate\Support\Collection
    {
        return collect(static::load()['lessons_without_course'] ?? [])
            ->map(fn($l) => (object)$l);
    }

    // -----------------------------------------------
    // Write: Courses
    // -----------------------------------------------

    public static function addCourse(array $data): object
    {
        $all  = static::load();
        $newId = collect($all['courses'])->max('course.id') + 1;

        $all['courses'][] = [
            'course' => [
                'id'         => $newId,
                'title'      => $data['title'],
                'amount'     => $data['amount'] ?? null,
                'image_url'  => $data['image_url'],
                'paid'       => $data['paidCourses'],
                'category'   => $data['category'],
                'desc'       => $data['desc'],
                'created_at' => now()->toDateTimeString(),
            ],
            'lessons' => [],
            'users'   => [],
        ];

        static::save($all);

        return (object)['success' => true, 'message' => 'Course added successfully', 'id' => $newId];
    }

    public static function updateCourse(int $courseId, array $data): object
    {
        $all    = static::load();
        $index  = collect($all['courses'])->search(fn($c) => $c['course']['id'] === $courseId);

        if ($index === false) {
            return (object)['success' => false, 'message' => 'Course not found'];
        }

        $all['courses'][$index]['course'] = array_merge(
            $all['courses'][$index]['course'],
            [
                'title'     => $data['title'],
                'amount'    => $data['amount'] ?? null,
                'image_url' => $data['image_url'],
                'paid'      => $data['paidCourses'],
                'category'  => $data['category'],
                'desc'      => $data['desc'],
            ]
        );

        static::save($all);

        return (object)['success' => true, 'message' => 'Course updated successfully'];
    }

    public static function deleteCourse(int $courseId): object
    {
        $all   = static::load();
        $index = collect($all['courses'])->search(fn($c) => $c['course']['id'] === $courseId);

        if ($index === false) {
            return (object)['success' => false, 'message' => 'Course not found'];
        }

        $imageUrl = $all['courses'][$index]['course']['image_url'] ?? null;
        array_splice($all['courses'], $index, 1);
        static::save($all);

        return (object)['success' => true, 'message' => 'Course deleted successfully', 'image_url' => $imageUrl];
    }

    // -----------------------------------------------
    // Write: Lessons
    // -----------------------------------------------

    public static function addLesson(int $courseId, array $data): object
    {
        $all         = static::load();
        $courseIndex = collect($all['courses'])->search(fn($c) => $c['course']['id'] === $courseId);

        if ($courseIndex === false) {
            return (object)['success' => false, 'message' => 'Course not found'];
        }

        $newId = collect($all['courses'])->flatMap(fn($c) => $c['lessons'])->max('id') + 1;
        $order = count($all['courses'][$courseIndex]['lessons']) + 1;

        $all['courses'][$courseIndex]['lessons'][] = [
            'id'        => $newId,
            'title'     => $data['title'],
            'length'    => $data['length'],
            'videolink' => $data['videolink'],
            'preview'   => $data['preview'] ?? false,
            'desc'      => $data['desc'],
            'category'  => $data['cat'] ?? null,
            'thumbnail' => $data['thumbnail'],
            'order'     => $order,
            'created_at'=> now()->toDateTimeString(),
        ];

        static::save($all);

        return (object)['success' => true, 'message' => 'Lesson added successfully', 'id' => $newId];
    }

    public static function updateLesson(int $lessonId, array $data): object
    {
        $all = static::load();

        foreach ($all['courses'] as $ci => $courseItem) {
            foreach ($courseItem['lessons'] as $li => $lesson) {
                if ($lesson['id'] === $lessonId) {
                    $all['courses'][$ci]['lessons'][$li] = array_merge($lesson, [
                        'title'     => $data['title'],
                        'length'    => $data['length'],
                        'videolink' => $data['videolink'],
                        'preview'   => $data['preview'] ?? false,
                        'desc'      => $data['desc'],
                        'category'  => $data['cat'] ?? null,
                        'thumbnail' => $data['thumbnail'],
                    ]);

                    static::save($all);
                    return (object)['success' => true, 'message' => 'Lesson updated successfully'];
                }
            }
        }

        return (object)['success' => false, 'message' => 'Lesson not found'];
    }

    public static function deleteLesson(int $lessonId): object
    {
        $all = static::load();

        foreach ($all['courses'] as $ci => $courseItem) {
            foreach ($courseItem['lessons'] as $li => $lesson) {
                if ($lesson['id'] === $lessonId) {
                    $imageUrl = $lesson['thumbnail'] ?? null;
                    array_splice($all['courses'][$ci]['lessons'], $li, 1);
                    static::save($all);
                    return (object)['success' => true, 'message' => 'Lesson deleted successfully', 'image_url' => $imageUrl];
                }
            }
        }

        return (object)['success' => false, 'message' => 'Lesson not found'];
    }

    // -----------------------------------------------
    // Write: Categories
    // -----------------------------------------------

    public static function addCategory(string $name): object
    {
        $all   = static::load();
        $newId = collect($all['categories'])->max('category.id') + 1;

        $all['categories'][] = [
            'category' => [
                'id'       => $newId,
                'category' => $name,
            ],
            'lessons' => [],
        ];

        static::save($all);

        return (object)['success' => true, 'message' => 'Category added successfully'];
    }

    public static function deleteCategory(int $id): object
    {
        $all   = static::load();
        $index = collect($all['categories'])->search(fn($c) => $c['category']['id'] === $id);

        if ($index === false) {
            return (object)['success' => false, 'message' => 'Category not found'];
        }

        array_splice($all['categories'], $index, 1);
        static::save($all);

        return (object)['success' => true, 'message' => 'Category deleted successfully'];
    }

    // -----------------------------------------------
    // Persistence
    // -----------------------------------------------

    protected static function save(array $data): void
    {
        $export  = "<?php\n\nreturn " . static::varExport($data) . ";\n";
        file_put_contents(resource_path('content/fragments/courses.php'), $export);
    }

    protected static function varExport(mixed $data, int $indent = 0): string
    {
        $pad = str_repeat('    ', $indent);

        if (is_array($data)) {
            $items = [];
            $isList = array_is_list($data);
            foreach ($data as $key => $value) {
                $k       = $isList ? '' : var_export($key, true) . ' => ';
                $items[] = $pad . '    ' . $k . static::varExport($value, $indent + 1);
            }
            return "[\n" . implode(",\n", $items) . ",\n" . $pad . ']';
        }

        return var_export($data, true);
    }

    // -----------------------------------------------
    // Mappers
    // -----------------------------------------------

    protected static function mapCourse(array $item): object
    {
        return (object)[
            'course'  => (object)$item['course'],
            'lessons' => collect($item['lessons'])->map(function ($l) {
                $l['thumbnail'] = $l['image_url'] ?? 'default-thumbnail.jpg';
                
                return (object)$l;
            }),
            'users'   => collect($item['users'])->map(fn($u) => (object)$u),
        ];
    }

    protected static function mapCategory(array $item): object
    {
        return (object)[
            'category' => (object)$item['category'],
            'lessons'  => collect($item['lessons'])->map(function ($less) {
                return (object)[
                    ...$less,
                    'category' => (object)$less['category'],
                ];
            }),
        ];
    }
}