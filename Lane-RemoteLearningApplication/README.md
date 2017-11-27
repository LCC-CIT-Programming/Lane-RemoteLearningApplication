# Important Notes
### AskQuestion() method in question.php
- This method is the only one that seems out of place.
- AskQuestion takes the input of a student asking a question (course number / subject / description).
- Validates the input of the student.
- Adds the question to the database.
- Updates the task of the user if necessary.
- Re-displays the view with any error/success message.


# Controller Actions
### Default [GET]
- Default case brings users to the login screen.

### Login [POST]
- Login is a case used to process success/error of a user login.

### Ask [GET]
- Ask is a case used to display the page for users to ask questions.

### Ask Question [POST]
- Ask Question is a case used to process the information provided by the user.  
- Displays an error if invalid input.
- This case calls the method "AskQuestion" that processes the question and displays the next page as necessary.

### Update Task [POST/AJAX]
- Update Task is a case that is called asynchronously when a user switches between the tasks they are currently working on.
- Ends the current task, and creates a new one.

### Update Location [POST/AJAX]
- Update Location is a case that is called asynchronously when a user switches between the location they are working from.
- Updates the current visit in session to the new location.

### Cancel Question [POST/AJAX]
- Cancel Question is a case that asynchronously calls a method called CancelQuestion
- The CancelQuestion method sets the status to Resolved and sets an end time to the question.

### Logout [GET]
- Logout is a case that ends all tasks, visits, and other relevant information and then destroys the session.

### Home [GET]
- Home is a case that displays the default page when a user is logged in.

### Display Questions [POST/AJAX]
- Display Questions is a case used to asynchronously load the table of unanswered questions.

### Accept Question [POST/AJAX]
- Accept Question is a case used by tutors to asynchronously accept questions.
- When this case is called, a resolution is created for the question.
- When the resolution is created, the object supports a "resolution" message but does not currently support tutors input.
- Finally the modal is updated with new information about the student the tutor is in contact with.

### Check Accepted [POST/AJAX]
- Check Accepted is a case that determines if any questions have been accepted by a tutor.
- Resolutions are created when the tutor accepts the question.
- Retrieves all unfinished resolutions from the database.
- Checks if the user has an uncompleted resolution.
- Displays a modal if necessary.

### Question Details [POST/AJAX]
- Question Details is a case used by tutors prior to accepting a question.
- This will open a modal and fetch/display detailed information regarding the question.

### Reopen Question [POST/AJAX]
- Reopen Question is a case used by tutors to reopen a question that a student has asked.
- This sets the openTime of the question object to null, and deletes the resolution created for the question.

### Escalate Question [POST/AJAX]
- Escalate Question is a case that asynchronously sets the status of a question to Escalated to inform the instructor.
- TODO: Instructor functionality for viewing escalated questions.

### Resolve Question [POST/AJAX]
- Resolve Question is a case that asynchronously sets the close time, marks the status as resolved, and sets the resolution to resolved.
- TODO: Allow tutor input for resolution description.

### Edit [GET]
- Edit is  a case used to display the page that allows users to update their login information.

### Edit Profile [POST]
- Edit Profile is a case used as the post version of the Edit page.
- Updates the users password if it is changed.

### Schedule [GET]
- Schedule is a case used to display the "calendar" of schedules for tutors.

### Edit Schedule [POST]
- Edit Schedule is a case used to add new hours to a tutors schedule.
- TODO: Add Validation to the times a user can enter.

### Delete Schedule [POST]
- Delete Schedule is a case used to delete hours from a tutors Schedule.
