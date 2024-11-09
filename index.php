<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment and Grade Processing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-title {
            text-align: left;
            font-size: 18px;
            margin-left: 200px;
            margin-top: 10px;
        }
        .form-field {
            text-align: left;
            font-size: 14px;
            margin-left: 200px;
            margin-top: 10px;
        }
        .input-field, .course-select, .age-input, .grade-input {
            margin-left: 200px;
            margin-top: 5px;
            padding: 5px;
            width: 900px;
            font-size: 14px;
        }
        .gender-field {
            margin-left: 200px;
            margin-top: 5px;
        }
        .gender-field input {
            margin-right: 10px;
        }
        .submit-btn {
            margin-top: 20px;
            padding: 5px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 200px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .hidden {
            display: none;
        }
        .display-section {
            margin-top: 30px;
            margin-left: 200px;
            font-size: 16px;
            width: 90%;
        }
        .passed {
            color: green;
        }
        .failed {
            color: red;
        }
        .display-section div {
            margin-bottom: 15px;
        }
        .display-section div strong {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }
    </style>
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

    <div id="gradeForm" class="hidden">
        <div class="form-title">Enter Grades for <span id="studentName"></span></div>
        <div class="form-field">Prelim Grade</div>
        <input type="number" class="grade-input" id="prelimGrade" min="0" max="100" step="1" oninput="computeAverage()" required>
        
        <div class="form-field">Midterm Grade</div>
        <input type="number" class="grade-input" id="midtermGrade" min="0" max="100" step="1" oninput="computeAverage()" required>
        
        <div class="form-field">Finals Grade</div>
        <input type="number" class="grade-input" id="finalsGrade" min="0" max="100" step="1" oninput="computeAverage()" required>
        
        <div class="form-field">Average Grade: <span id="averageGrade">N/A</span></div>
        
        <div class="form-field">
            <button class="submit-btn" type="button" onclick="submitGrades()">Submit Grades</button>
        </div>
    </div>

    <div id="submittedData" class="display-section hidden"></div>

    <script>
        let studentInfo = {};

        function submitStudentInfo() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const age = document.getElementById('age').value;
            const gender = document.querySelector('input[name="gender"]:checked');
            const course = document.getElementById('course').value;
            const email = document.getElementById('email').value;

            if (!firstName || !lastName || !age || !gender || !course || !email) {
                alert("Please fill in all the fields before submitting.");
                return false;
            }

            studentInfo = {
                firstName,
                lastName,
                age,
                gender: gender.value,
                course,
                email
            };

            document.getElementById('studentName').textContent = `${firstName} ${lastName} (${course})`;

            document.getElementById('studentForm').classList.add('hidden');
            document.getElementById('gradeForm').classList.remove('hidden');
        }

        function computeAverage() {
            const prelimGrade = parseFloat(document.getElementById('prelimGrade').value) || 0;
            const midtermGrade = parseFloat(document.getElementById('midtermGrade').value) || 0;
            const finalsGrade = parseFloat(document.getElementById('finalsGrade').value) || 0;
            const averageGrade = (prelimGrade + midtermGrade + finalsGrade) / 3;
            const averageDisplay = isNaN(averageGrade) ? "N/A" : averageGrade.toFixed(2);

            const averageGradeElement = document.getElementById('averageGrade');
            averageGradeElement.textContent = averageDisplay;

            if (!isNaN(averageGrade)) {
                if (averageGrade >= 75) {
                    averageGradeElement.classList.add('passed');
                    averageGradeElement.classList.remove('failed');
                } else {
                    averageGradeElement.classList.add('failed');
                    averageGradeElement.classList.remove('passed');
                }
            } else {
                averageGradeElement.classList.remove('passed', 'failed');
            }
        }

        function submitGrades() {
            const prelimGrade = parseFloat(document.getElementById('prelimGrade').value);
            const midtermGrade = parseFloat(document.getElementById('midtermGrade').value);
            const finalsGrade = parseFloat(document.getElementById('finalsGrade').value);

            if (isNaN(prelimGrade) || isNaN(midtermGrade) || isNaN(finalsGrade)) {
                alert("Please fill in all grade fields.");
                return false;
            }

            const averageGrade = ((prelimGrade + midtermGrade + finalsGrade) / 3).toFixed(2);
            const gradeStatus = averageGrade >= 75 ? 'Passed' : 'Failed';
            const gradeStatusClass = averageGrade >= 75 ? 'passed' : 'failed';

            const submittedDataDiv = document.getElementById('submittedData');
            submittedDataDiv.innerHTML = `
                <div><strong>Student Details:</strong></div>
                <div><strong>First Name:</strong> ${studentInfo.firstName}</div>
                <div><strong>Last Name:</strong> ${studentInfo.lastName}</div>
                <div><strong>Age:</strong> ${studentInfo.age}</div>
                <div><strong>Gender:</strong> ${studentInfo.gender}</div>
                <div><strong>Course:</strong> ${studentInfo.course}</div>
                <div><strong>Email:</strong> ${studentInfo.email}</div>
                <div><strong>Grades:</strong></div>
                <div><strong>Prelim:</strong> ${prelimGrade}</div>
                <div><strong>Midterm:</strong> ${midtermGrade}</div>
                <div><strong>Finals:</strong> ${finalsGrade}</div>
                <div><strong>Average Grade:</strong> ${averageGrade} <span class="${gradeStatusClass}">(${gradeStatus})</span></div>
            `;
            submittedDataDiv.classList.remove('hidden');

            document.getElementById('studentForm').classList.remove('hidden');
            document.getElementById('gradeForm').classList.add('hidden');
            
            document.getElementById('firstName').value = '';
            document.getElementById('lastName').value = '';
            document.getElementById('age').value = '';
            document.getElementById('course').value = '';
            document.getElementById('email').value = '';
            document.querySelector('input[name="gender"]:checked').checked = false;

            document.getElementById('gradeForm').reset();
        }
    </script>
</body>
</html>
