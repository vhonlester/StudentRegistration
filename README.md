# StudentRegSys Documentation

## Overview
*StudentRegSys* is a web-based student registration and management system built with Laravel. It provides features for administrators to manage students and sections efficiently, allowing for organized tracking of student enrollments by academic sections.

---

## Objectives
- To provide an efficient and user-friendly platform for managing student registrations.
- To automate student enrollment, tracking, and organization by sections.
- To enable administrators to manage students and sections effectively.
- To track student assignments to specific academic sections.
- To enhance learning in system integration and architecture using Laravel.

---

## Features / Functionality

### Student Management
- *Registration:* Add new students with personal and academic information.
- *View Students:* Display all registered students in a paginated list.
- *Edit Students:* Update student information including section assignment.
- *Delete Students:* Remove students from the system.

### Section Management
- *Create Sections:* Add new academic sections with capacity limits.
- *Manage Sections:* Edit and delete section information.
- *View Section Details:* Display all students assigned to a section.
- *Track Capacity:* Monitor section capacity and enrollment.

### Additional Features
- *Student-Section Assignment:* Assign students to appropriate sections.
- *Search and Filter:* Navigate through students and sections easily.
- *Responsive Interface:* User-friendly design with Bootstrap styling.

---

## Installation Instructions

1. *Clone the repository:*
```bash
git clone <repo-url>
cd student-registration
```

2. *Install dependencies:*
```bash
composer install
npm install
```

3. *Environment setup:*
   - Copy `.env.example` to `.env` and configure database credentials.
   - Generate application key: `php artisan key:generate`

4. *Database setup:*
   - Create your database and update `.env`.
   - Run migrations and seeders:
```bash
php artisan migrate --seed
```

5. *Run the application:*
```bash
php artisan serve
npm run dev
```

---

## Usage

### Accessing the System
- The homepage redirects to the students index at `/students`.
- Navigate through students and sections using the sidebar links.
- Use the create buttons to add new students or sections.

### Student Registration
1. Click "Register New Student" button.
2. Fill in student details:
   - Student ID (unique)
   - First Name and Last Name
   - Email (unique)
   - Phone Number
   - Date of Birth
   - Address
   - Section Assignment
3. Submit the form to register the student.

### Section Management
1. Navigate to Sections from the sidebar.
2. Create new sections with:
   - Name
   - Code (unique)
   - Description
   - Capacity (max 100)
3. Edit or delete sections as needed.

---

## Code Snippets

### Student Controller

#### List All Students
```php
public function index()
{
    $students = Student::with('section')->paginate(10);
    return view('students.index', compact('students'));
}
```

#### Create/Save Student
```php
public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|string|max:20|unique:students',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:students',
        'phone' => 'nullable|string|max:20',
        'date_of_birth' => 'required|date|before:today',
        'address' => 'nullable|string|max:500',
        'section_id' => 'required|exists:sections,id'
    ]);

    Student::create($request->all());

    return redirect()->route('students.index')
        ->with('success', 'Student registered successfully.');
}
```

#### Edit/Update Student
```php
public function update(Request $request, Student $student)
{
    $request->validate([
        'student_id' => 'required|string|max:20|unique:students,student_id,' . $student->id,
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email,' . $student->id,
        'phone' => 'nullable|string|max:20',
        'date_of_birth' => 'required|date|before:today',
        'address' => 'nullable|string|max:500',
        'section_id' => 'required|exists:sections,id'
    ]);

    $student->update($request->all());

    return redirect()->route('students.index')
        ->with('success', 'Student updated successfully.');
}
```

#### Delete Student
```php
public function destroy(Student $student)
{
    $student->delete();

    return redirect()->route('students.index')
        ->with('success', 'Student deleted successfully.');
}
```

### Section Controller

#### Create Section
```php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:sections',
        'description' => 'nullable|string',
        'capacity' => 'required|integer|min:1|max:100'
    ]);

    Section::create($request->all());

    return redirect()->route('sections.index')
        ->with('success', 'Section created successfully.');
}
```

#### Update Section
```php
public function update(Request $request, Section $section)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:sections,code,' . $section->id,
        'description' => 'nullable|string',
        'capacity' => 'required|integer|min:1|max:100'
    ]);

    $section->update($request->all());

    return redirect()->route('sections.index')
        ->with('success', 'Section updated successfully.');
}
```

---

## Folder Structure
```
app/
├── Http/Controllers/
│   ├── StudentController.php
│   └── SectionController.php
└── Models/
    ├── Student.php
    ├── Section.php
    └── User.php
resources/
└── views/
    ├── layouts/
    │   └── app.blade.php
    ├── students/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── show.blade.php
    └── sections/
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php
routes/
└── web.php
database/
├── migrations/
│   ├── 2025_09_24_012233_create_sections_table.php
│   └── 2025_09_24_012239_create_students_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── SectionSeeder.php
```

---

## Database Schema

### sections
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Section name |
| code | string | Unique section code |
| description | text | Section description (nullable) |
| capacity | integer | Maximum capacity (default: 30) |
| timestamps | timestamp | Created and updated timestamps |

### students
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| student_id | string | Unique student identifier |
| first_name | string | Student's first name |
| last_name | string | Student's last name |
| email | string | Student's email (unique) |
| phone | string | Student's phone (nullable) |
| date_of_birth | date | Student's date of birth |
| address | string | Student's address (nullable) |
| section_id | foreignId | Foreign key to sections table |
| timestamps | timestamp | Created and updated timestamps |

---

## Relationships

### Student Model
```php
public function section(): BelongsTo
{
    return $this->belongsTo(Section::class);
}
```

### Section Model
```php
public function students(): HasMany
{
    return $this->hasMany(Student::class);
}
```

---

## Routes

### Students
- `GET /students` - List all students
- `GET /students/create` - Show create form
- `POST /students` - Store new student
- `GET /students/{id}` - Show student details
- `GET /students/{id}/edit` - Show edit form
- `PUT /students/{id}` - Update student
- `DELETE /students/{id}` - Delete student

### Sections
- `GET /sections` - List all sections
- `GET /sections/create` - Show create form
- `POST /sections` - Store new section
- `GET /sections/{id}` - Show section details
- `GET /sections/{id}/edit` - Show edit form
- `PUT /sections/{id}` - Update section
- `DELETE /sections/{id}` - Delete section

---

## Seeder Data

The system includes a `SectionSeeder` that provides default sections:
- Computer Science A (CS-A)
- Computer Science B (CS-B)
- Information Technology (IT-01)
- Software Engineering (SE-01)
- Data Science (DS-01)

---

## Technologies Used
- **Framework:** Laravel 11
- **Frontend:** Bootstrap 5, Font Awesome
- **Database:** SQLite (default)
- **PHP:** 8.2+

---

## Contributors
- *Vhon Lester C. Subala*
- Developed for DMMMSU System Integration and Architecture 2 (AY 2025-26).
