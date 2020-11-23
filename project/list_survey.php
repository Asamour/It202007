<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
$query = "";
$query1= "";
$results = [];
if (isset($_POST["query"])){
    $query = $_POST["query"];
}
if (isset($_POST["query1"])){
    $query1 = $_POST["query1"];
}


?>
<?php
if (isset($_POST["search"]) && !isset($_POST["category"]) && !empty($query) && empty($query1)){
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Survey Where (title like :q) LIMIT 10");
    $r = $stmt->execute([":q" => "%$query%"]);
    if ($r) {
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    else{
        flash("There was a problem fetching the results");
    }
}
elseif (isset($_POST["search"]) && !empty($query) && $_GET["category"]) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Survey Where visbility=1 AND (title like :q) LIMIT 10");
    $r = $stmt->execute([":q" => "%$query%"]);
    if ($r) {
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    else{
        flash("There was a problem fetching the results");
    }
}
else{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Survey Where visbility=2 AND LIMIT 10");
    $r = $stmt->execute([":q" => "%$query%"]);
    if ($r) {
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    else{
        flash("There was a problem fetching the results");
    }
}

?>
<div class="container-fluid">
    <h3>List Surveys</h3>
    <form method="POST" class="form-inline">
        <input class="form-control" name="query" placeholder="Search" value="<?php safer_echo($query); ?>"/>
        <input class="btn btn-primary" type="submit" value="Search" name="search"/>
    </form>

    <form method="POST" class="form-inline">
        <input class="form-control" name="query1" placeholder="category" value="<?php safer_echo($query1); ?>"/>
        <input class="btn btn-primary" type="submit" value="category" name="category"/>
    </form>

    <div class="results">
        <?php if (count($results) > 0): ?>
        <div class="list-group">
            <?php foreach ($results as $r): ?>
            <div class="list-group-item">
                <div class="row">
                    <div class="col">
                        <div>Title:</div>
                        <div><?php safer_echo($r["title"]); ?></div>
                    </div>
                    <div class="col">
                        <a class="btn btn-success" type="button" href="test_view_survey.php?id=<?php safer_echo($r['id']); ?>">View</a>
                        <a class="btn btn-success" type="button" href="text_create_question.php?id=<?php safer_echo($r['id']); ?>">Add question</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p>No results</p>
        <?php endif; ?>
    </div>
</div>
