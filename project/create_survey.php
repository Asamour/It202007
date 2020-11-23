<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
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
