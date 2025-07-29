<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Student Information</h1>
    <div>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    </div>
    <form method="POST" action="{{route('student.update',['student'=> $student])}}">
        @csrf
        @method('put')
        <!-- Student ID -->
        <label for="student_id">Student ID:</label><br>
        <input type="text" id="student_id" name="student_id" value="{{$student->student_id}}" required><br><br>

        <!-- Name -->
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{$student->name}}" required><br><br>

        <!-- Class -->
        <label for="class">Class:</label><br>
        <input type="text" id="class" name="class" value="{{$student->class}}" required><br><br>

        <!-- Semester -->
        <label for="semester">Semester:</label><br>
        <input type="text" id="semester" name="semester" value="{{$student->semester}}" required><br><br>

        <!-- Email -->
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{$student->email}}" required><br><br>

        <!-- Phone (optional) -->
        <label for="phone">Phone (Optional):</label><br>
        <input type="text" id="phone" name="phone" value="{{$student->phone}}"><br><br>

        <!-- Date of Birth (optional) -->
        <label for="dob">Date of Birth (Optional):</label><br>
        <input type="date" id="dob" name="dob" value="{{$student->dob}}"><br><br>

        <!-- Submit Button -->
        <button type="submit">Update</button>
    </form>
</body>
</html>