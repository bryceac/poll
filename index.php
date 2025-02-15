<?php include("includes/functions.php"); ?>
<?php $polls = retrieve_polls(); ?>
<?php $current_poll = empty(polls) ? NULL : $polls[count($polls) -1]; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($current_poll->question); ?></title>
    <link rel="stylesheet" href="assets/style.css" media="all">
    <meta http-equiv="refresh" content="600">
</head>
<body>
    <?php if (isset($current_poll)) { ?>
        <h1><?php echo htmlspecialchars($current_poll->question); ?></h1>

        <div id="poll">
            <?php if ($current_poll->total_votes() > 0) { ?>
                <?php foreach($current_poll->answers as $answer) { ?>
                    <div class="response">
                        <label for="<?php echo $answer->id; ?>"><?php echo htmlspecialchars($answer->value); ?></label>
                        <meter value="<?php echo $answer->votes; ?>" min="0" max="<?php echo $current_poll->total_votes ?>"></meter>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <?php foreach($current_poll->answers as $answer) { ?>
                    <div class="response">
                        <p><?php echo htmlspecialchars($answer->value); ?></p>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>Sorry, There are no polls to display at this time.</p>
    <?php } ?>
</body>
</html>
