<?php
require __DIR__ . '/../incl/config.php';

function fetchNews($conn)
{

    $request = $conn->prepare(" SELECT news_id, news_title, news_short_description, news_author, news_published_on, news_category FROM news ORDER BY news_id DESC ");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}


function getAnArticle($id_article, $conn)
{

    $request = $conn->prepare(" SELECT news_id,  news_title, news_full_content, news_author, news_published_on, news_category FROM news WHERE news_id = ? ");
    return $request->execute(array($id_article)) ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}


function getOtherArticles($differ_id, $conn)
{
    $request = $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on, news_category FROM news  WHERE news_id != ? ");
    return $request->execute(array($differ_id)) ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}

function getArticleCategory($conn)
{
    $request = $conn->prepare(" SELECT news_id, news_category FROM news  WHERE news_id != ? ");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}

$connection = new PDO($dsn, $username, $password, $options);
$success = "";
$failure = "";
$updating = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        //LOAD NEWS
        if (isset($_GET['newseditid'])) {
            $id = $_GET['newseditid'];
            $sql = "SELECT * FROM news WHERE news_id = :news_id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':news_id', $id);
            $statement->execute();
            $newsedit = $statement->fetch(PDO::FETCH_ASSOC);
            //var_dump($statement->debugDumpParams());
            $updating = true;
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        /** NEWS UPDATING WORKING */
        if (isset($_POST['btnUpdateNews'])) {
            $id = $_POST['newsid'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $publishdate = $_POST['publish'];
            $shortdesc = $_POST['shortdesc'];
            $fullcontent = $_POST['fulltext'];
            $ctgry = $_POST['newscat'];
            $statement = $connection->prepare(
                "UPDATE news SET news_title=:news_title, 
                        news_title=:news_title,
                        news_author=:news_author,
                        news_published_on=:news_published_on,
                        news_short_description=:news_short_description,
                        news_full_content=:news_full_content,
                        news_category=:news_category
                        WHERE news_id=:news_id");
            $statement->bindParam(':news_id', $id, PDO::PARAM_INT);
            $statement->bindValue(':news_title', $title);
            $statement->bindValue(':news_author', $author);
            $statement->bindValue(':news_published_on', $publishdate);
            $statement->bindValue(':news_short_description', $shortdesc);
            $statement->bindValue(':news_full_content', $fullcontent);
            $statement->bindValue(':news_category', $ctgry);
            $statement->execute();
            $success = "Article successfully updated!";
            echo('<meta http-equiv="refresh" content="2;url=index.php">');
        }
    } catch (PDOException $error) {
        $failure = "<br>" . $error->getMessage();
    }
}