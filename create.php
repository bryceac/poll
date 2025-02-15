<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>New Poll</title>
        <link rel="stylesheet" href="form.css" media="all">
    </head>
    <body>
        <h1>Create Poll</h1>
        <div id="poll_form">
            <form action="" method="post" class="response">
                <p><label for="question">Enter Poll Prompt: </label>
                <input type="text" name="question" id="question"></p>
                <p><label for="answers">Enter Responses: </label></p>
                <p><textarea name="answers" id="answers" placeholder="Enter options here. One option per line." rows="32"></textarea></p>
                <p><input type="submit" value="Submit"></p>
            </form>
        </div>
    </body>
</html>