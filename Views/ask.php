<?php include 'header.php'; ?>
<div class="container-fluid" style="margin-top:50px;">
<div id="questionFormContainer" class="col-md-offset-3 col-md-6 well">
                    <h1 class="text-center text-primary">New Question</h1>

                    <form  method="post" action=".?=ask_question" class="form-horizontal" id="ask_question_form">
					<input type="hidden" name="action" value="ask_question" />
                        <div class="form-group">
                            <label class="control-label">Select A Course</label>
                            <div class="col-md-9">
                                <select id="course" name="courseSelect" class="form-control">

									<?php
                                        $user = $_SESSION['user'];
                                        $courses = $_SESSION['courses'];
                                     foreach ($courses as $course) :
                                        {
                                            echo '<option value="' . $course->getCourseNumber() . '">'
                                                . $course->getCourseName() .
                                                '</option>';
                                        }
                                        endforeach;
                                    ?>

                                </select>
                            </div>
                        </div>


                        <div class="row form-group">
							<label class="control-label">Problem Subject</label>
                            <div class="col-md-9">
                                <input type="text" name="subject" class="form-control"  placeholder="Subject" required>
                            </div>
                        </div>

                        <div class="row form-group col-md-12">
                            <textarea id="question" name="description" class="form-control"  rows="5" placeholder="Enter your question" required></textarea>
                        </div>


							<div class="col-md-offset-2 col-md-2">
								<button type="submit" class="btn btn-primary">Submit Question</button>
							</div>

							<div class="col-md-offset-2 col-md-2">
								<a href="?action=home"><input id="returnBtn" class="btn btn-primary" type="button" value="Take me back!"></a>
							</div>
						

						<div class="row form-group col-md-12 text-center" style="margin-top:10px;">
							<div class="col-md-offset-2 col-md-8">
								  <span class="error text-primary" style="font-weight:bold"><?php echo $questionStatus; ?></span>
							</div>
                        </div>
                    </form>
      </div>
</div>
<?php include 'footer.php'; ?>
