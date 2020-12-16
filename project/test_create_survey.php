<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>

<form method="POST">
        <label>Title</label>
        <input name="title" placeholder="Title"/>
        <label>Description</label>
        <input type="TEXT" name="Description"/>
        <label>Visibility</label>
        <select name="visibility">
                <option value="0">Draft</option>
                <option value="1">Private</option>
                <option value="2">Public</option>
        </select>

        <input type="submit" name="save" value="Create"/>
</form>

<?php
if(isset($_POST["save"])){
        //TODO add proper validation/checks
        $title = $_POST["title"];
        $description = $_POST["Description"];
        $visibility = $_POST["visibility"];
        $created = date('Y-m-d H:i:s');//calc
        $modified = date('Y-m-d H:i:s');//calc
        //$nst = date('Y-m-d H:i:s');//calc
        $user = get_user_id();
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Survey (title, description, visibility, created, modified, user_id) VALUES(:title, :description,:visibility,:created,:modified,:user)");
        $r = $stmt->execute([
                ":title"=>$title,
                ":description"=>$description,
                ":visibility"=>$visibility,
                ":created"=>$created,
                ":modified"=>$modified,
                ":user"=>$user
                //":user"=>$user

        ]);
        if($r){
                flash("Created successfully with id: " . $db->lastInsertId());
        }
        else{
                $e = $stmt->errorInfo();
                flash("Error creating: " . var_export($e, true));
        }
}
?>
<?php require(__DIR__ . "/partials/flash.php");
afsconnect1-52 project >: nano test_edit_survey.php
afsconnect1-53 project >: nano test_edit_survey.php
afsconnect1-53 project >: git branch
fatal: Not a git repository (or any parent up to mount point /afs)
Stopping at filesystem boundary (GIT_DISCOVERY_ACROSS_FILESYSTEM not set).
afsconnect1-54 project >: cat test_create_survey.php
<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>

<form method="POST">
        <label>Title</label>
        <input name="title" placeholder="Title"/>
        <label>Description</label>
        <input type="TEXT" name="Description"/>
        <label>Visibility</label>
        <select name="visibility">
                <option value="0">Draft</option>
                <option value="1">Private</option>
                <option value="2">Public</option>
        </select>

        <input type="submit" name="save" value="Create"/>
</form>

<?php
if(isset($_POST["save"])){
        //TODO add proper validation/checks
        $title = $_POST["title"];
        $description = $_POST["Description"];
        $visibility = $_POST["visibility"];
        $created = date('Y-m-d H:i:s');//calc
        $modified = date('Y-m-d H:i:s');//calc
        //$nst = date('Y-m-d H:i:s');//calc
        $user = get_user_id();
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Survey (title, description, visibility, created, modified, user_id) VALUES(:title, :description,:visibility,:created,:modified,:user)");
        $r = $stmt->execute([
                ":title"=>$title,
                ":description"=>$description,
                ":visibility"=>$visibility,
                ":created"=>$created,
                ":modified"=>$modified,
                ":user"=>$user
                //":user"=>$user

        ]);
        if($r){
                flash("Created successfully with id: " . $db->lastInsertId());
        }
        else{
                $e = $stmt->errorInfo();
                flash("Error creating: " . var_export($e, true));
        }
}
?>
<?php require(__DIR__ . "/partials/flash.php");
