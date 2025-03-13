<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MockTest;
use App\Models\MockTestQuestion;
use App\Models\Course;

class MockTestSeeder extends Seeder
{
    public function run(): void
    {
        $courseIds = Course::pluck('id')->toArray();

        if (empty($courseIds)) {
            throw new \Exception('No courses found. Please seed courses first.');
        }

        $programmingQuestions = [
            [
                'question' => 'What is the output of echo "Hello" . " " . "World";?',
                'options' => ['Hello World', 'HelloWorld', 'Error', 'None'],
                'correct_answer' => 'Hello World'
            ],
            [
                'question' => 'Which of the following is used to declare a constant in PHP?',
                'options' => ['const', 'define()', 'both a and b', 'constant'],
                'correct_answer' => 'both a and b'
            ],
            [
                'question' => 'What is the correct way to start a PHP block?',
                'options' => ['<?php', '<php', '<?', '<p>'],
                'correct_answer' => '<?php'
            ],
            [
                'question' => 'What is the purpose of the instanceof operator in PHP?',
                'options' => ['Check if an object is instance of a class', 'Compare two values', 'Mathematical operation', 'None'],
                'correct_answer' => 'Check if an object is instance of a class'
            ],
            [
                'question' => 'Which function is used to get the length of a string in PHP?',
                'options' => ['strlen()', 'length()', 'count()', 'size()'],
                'correct_answer' => 'strlen()'
            ],
            [
                'question' => 'What does PDO stand for?',
                'options' => ['PHP Data Objects', 'PHP Database Operations', 'Programming Data Objects', 'Public Data Objects'],
                'correct_answer' => 'PHP Data Objects'
            ],
            [
                'question' => 'Which of the following is not a valid PHP variable name?',
                'options' => ['$my-var', '$myvar', '$_myvar', '$my_var'],
                'correct_answer' => '$my-var'
            ],
            [
                'question' => 'What is the difference between == and === in PHP?',
                'options' => ['Value vs Value+Type', 'No difference', 'Syntax only', 'Performance'],
                'correct_answer' => 'Value vs Value+Type'
            ],
            [
                'question' => 'Which superglobal variable holds form data in PHP?',
                'options' => ['$_POST', '$_FORM', '$_DATA', '$GLOBALS'],
                'correct_answer' => '$_POST'
            ],
            [
                'question' => 'What is the default method for HTML forms?',
                'options' => ['GET', 'POST', 'PUT', 'DELETE'],
                'correct_answer' => 'GET'
            ],
            [
                'question' => 'What is the purpose of the "use" keyword in PHP?',
                'options' => ['Import namespaces', 'Define variables', 'Create functions', 'Loop control'],
                'correct_answer' => 'Import namespaces'
            ],
            [
                'question' => 'Which PHP function is used to connect to a MySQL database?',
                'options' => ['mysqli_connect()', 'mysql_connect()', 'database_connect()', 'db_connect()'],
                'correct_answer' => 'mysqli_connect()'
            ],
            [
                'question' => 'What is the purpose of array_merge() in PHP?',
                'options' => ['Combines arrays', 'Sorts arrays', 'Splits arrays', 'Counts arrays'],
                'correct_answer' => 'Combines arrays'
            ],
            [
                'question' => 'What does MVC stand for?',
                'options' => ['Model View Controller', 'Multiple View Control', 'Model Virtual Control', 'Modern View Class'],
                'correct_answer' => 'Model View Controller'
            ],
            [
                'question' => 'Which function removes last element from an array in PHP?',
                'options' => ['array_pop()', 'array_push()', 'array_shift()', 'array_unshift()'],
                'correct_answer' => 'array_pop()'
            ],
            [
                'question' => 'What is Laravel?',
                'options' => ['PHP Framework', 'JavaScript Library', 'Database', 'Text Editor'],
                'correct_answer' => 'PHP Framework'
            ],
            [
                'question' => 'Which of these is not a PHP loop?',
                'options' => ['repeat-until', 'while', 'for', 'foreach'],
                'correct_answer' => 'repeat-until'
            ],
            [
                'question' => 'What is the purpose of composer in PHP?',
                'options' => ['Package Manager', 'Text Editor', 'Web Server', 'Database'],
                'correct_answer' => 'Package Manager'
            ],
            [
                'question' => 'What does CRUD stand for?',
                'options' => ['Create Read Update Delete', 'Create Run Update Debug', 'Copy Read Update Delete', 'Create Read Undo Delete'],
                'correct_answer' => 'Create Read Update Delete'
            ],
            [
                'question' => 'Which HTTP method is idempotent?',
                'options' => ['GET', 'POST', 'PATCH', 'DELETE'],
                'correct_answer' => 'GET'
            ]
        ];

        $testTitles = [
            'PHP Basics Quiz',
            'JavaScript Fundamentals',
            'Python Programming Test',
            'Data Structures Quiz',
            'OOP Concepts Test'
        ];

        for ($i = 0; $i < 20; $i++) {
            $mockTest = MockTest::create([
                'test_title' => $testTitles[array_rand($testTitles)] . ' #' . ($i + 1),
                'course_id' => $courseIds[array_rand($courseIds)], // Use existing course IDs
                'level' => ['beginners', 'intermediate', 'hard'][rand(0, 2)],
                'status' => true
            ]);

            // Get random questions (using array_rand correctly)
            $questionIndexes = array_rand($programmingQuestions, min(10, count($programmingQuestions)));
            $questionIndexes = is_array($questionIndexes) ? $questionIndexes : [$questionIndexes];

            foreach($questionIndexes as $index) {
                MockTestQuestion::create([
                    'mocktest_id' => $mockTest->id,
                    'question' => $programmingQuestions[$index]['question'],
                    'options' => json_encode($programmingQuestions[$index]['options']),
                    'correct_answer' => $programmingQuestions[$index]['correct_answer'],
                    'marks' => rand(1, 5)
                ]);
            }
        }
    }
}
