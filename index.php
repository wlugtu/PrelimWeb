<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="title">Student Enrollment and Grade Processing System</div>

<div id="studentForm">
    <div class="form-title">Student Enrollment Form</div>
    <div class="form-field">First Name</div>
    <input type="text" class="input-field" id="firstName" required>
    
    <div class="form-field">Last Name</div>
    <input type="text" class="input-field" id="lastName" required>
    
    <div class="form-field">Age</div>
    <input type="number" class="age-input" id="age" min="0" max="150" step="1" required>
    
    <div class="form-field">Gender</div>
    <div class="gender-field" required>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
    </div>
    
    <div class="form-field">Course</div>
    <select class="course-select" id="course" required>
        <option value="">Select Course</option>
        <option value="ABSYCH">ABSYCH</option>
        <option value="BSIT">BSIT</option>
        <option value="BSBA">BSBA</option>
        <option value="BSTM">BSTM</option>
        <option value="BSHM">BSHM</option>
    </select>
    
    <div class="form-field">Email</div>
    <input type="email" class="input-field" id="email" required>
    
    <div class="form-field">
        <button class="submit-btn" type="button" onclick="submitStudentInfo()">Submit Student Information</button>
    </div>
</div>

    
</body>
</html>