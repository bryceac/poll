<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>New Poll</title>
    </head>
    <body>
        <h1>Create Poll</h1>
        <div id="poll">
            <form action="" method="post" class="response">
                <p><label for="question">Enter Poll Prompt: </label>
                <input type="text" name="question" id="question"></p>
                <p><label for="answers">Enter Poll Prompt: </label></p>
                <textarea name="answers" id="answers" placeholder="Enter options here. One option per line.">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>