<?php
require __DIR__.'/../incl/config.php';

function fetchNews( $conn )
{

    $request = $conn->prepare(" SELECT news_id, news_title, news_short_description, news_author, news_published_on, news_category FROM news ORDER BY news_id DESC ");
    return $request->execute() ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}


function getAnArticle( $id_article, $conn )
{

    $request =  $conn->prepare(" SELECT news_id,  news_title, news_full_content, news_author, news_published_on, news_category FROM news WHERE news_id = ? ");
    return $request->execute(array($id_article)) ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}


function getOtherArticles( $differ_id, $conn )
{
    $request =  $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on, news_category FROM news  WHERE news_id != ? ");
    return $request->execute(array($differ_id)) ? $request->fetchAll(PDO::FETCH_ASSOC) : false;
}