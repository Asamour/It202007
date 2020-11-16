<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
    <h3>Create Answer</h3>
    <form method="POST">
        <label>Answer</label>
        <input name="answer" placeholder="answer"/>
        <label>Question</label>
        <select name="question_id">
                <option value="0"> Question 1</option>
                <option value="1"> Question 2</option>
                <option value="2"> Question 3</option>
                <option value="3"> Question 4</option>
        </select>

        <input type="submit" name="save" value="Create"/>
    </form>

<?php
if (isset($_POST["save"])) {
    //TODO add proper validation/checks
    $quest = $_POST["answer"];
    $survey= $_POST["question_id"];
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Answers (answer, question_id) VALUES(:quest, :survey)");
    $r = $stmt->execute([
        ":quest" => $quest,
        ":survey" => $survey,


    ]);
    if ($r) {
        flash("Created successfully with id: " . $db->lastInsertId());
    }
    else {
        $e = $stmt->errorInfo();
        flash("Error creating: " . var_export($e, true));
    }
}
?>
<?php require(__DIR__ . "/partials/flash.php");
