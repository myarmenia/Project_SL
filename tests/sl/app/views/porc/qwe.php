<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/lib');
ini_set('include_path', $_SERVER['DOCUMENT_ROOT'].'/lib');

//
//DROP TABLE IF EXISTS test.articles;
//CREATE TABLE `articles` (
//`id` int(11) NOT NULL AUTO_INCREMENT,
//  `title` varchar(50) NOT NULL,
//  `content` text NOT NULL,
//  `date_created` int(11) DEFAULT NULL,
//  `author` varchar(30) NOT NULL,
//  PRIMARY KEY (`id`)
//) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

//Подключаем Zend_Search_Lucene
require_once 'Zend/Search/Lucene.php';

//Это функция для добавления записи в поисковый индекс
function addtoIndex($index, $article_id, $title, $content, $author, $date_created)
{
    $doc = new Zend_Search_Lucene_Document();
    $doc->addField(Zend_Search_Lucene_Field::keyword('article_id', $article_id, 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::Text('title', $title, 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::Text('content', $content, 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::Unindexed('author', $author, 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::Unindexed('date_created', $date_created, 'utf-8'));
    $index->addDocument($doc);
    $index->commit();
}

//Коннектимся к БД и выбираем таблицу
mysql_connect("127.0.0.1","root","") or die("connection has been lost");
mysql_select_db("test") or die("db doesn't exists");


$title = $_POST['title'];
$content = $_POST['content'];
$author = $_POST['author'];
$time = time();


try {
    $index = Zend_Search_Lucene::open('searchIndex');
}
catch( Exception $e )
{
    $index = Zend_Search_Lucene::create('searchIndex');
}
//Поиск будет безразличен регистру и иметь кодировку utf-8
Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

//Будем проводить поиск только если посковый запрос будет >2 символов
if(strlen($_GET['search'])>2)
{
    $query = Zend_Search_Lucene_Search_QueryParser::parse($_GET['search']); // Парсим запрос

    try {
        $results  = $index->find($query); //Тут идет сам поиск
    }
    catch( Exception $e )
    {
        echo "Какая-то ошибка. Если убрать try-catch - узнаяем какая";
    }
}

// Тут все просто, это для получения данных для редактирования записи, потом все это дело впишем в форму
if($_GET['action']=='edit')
{
    $query = "select * from articles where id = '".$_GET['id']."'";
    $res = mysql_query($query);
    $article_edit = mysql_fetch_array($res);
}

// Это для удаления
if($_GET['action']=='delete')
{
    //Нам нужно, чтобы при удалении записи из базы, в индексе запись также удалялась.
    //Заметьте, при удаления записи из таблицы БД, мы также ищем эту запись по article_id в индексе
    $term = new Zend_Search_Lucene_Index_Term($_GET['id'], 'article_id');
    $query = new Zend_Search_Lucene_Search_Query_Term($term);
    $d_results = $index->find($query); // результат поиска помещаем сюда
    //echo count($d_results)." - for del";

    //Если есть запись или записи, то
    if(count($d_results) > 0)
    {
        // перебираем все записи
        foreach($d_results as $result)
        {
            echo "Удаляем запись с ID: ".$result->id;
            $index->delete($result->id); // И вот в этой строке удаляем запись из индекса
            //Смотрите: Запись удаляем не по article_id, а по id(это не поле из таблицы БД) - это свой идентификатор Zend_Search_Lucene
        }
        $index->commit(); //Полезная функция, что-то вроде проверки и корректировки индексов после действия над ними
    }
    // тут удаляем запись из БД
    $query = "delete from articles where id = '".$_GET['id']."'";
    $res = mysql_query($query);
}

//Ниже часть - для создания новой записи и редактирования старой
if(!empty($_POST['title'])&&!empty($_POST['content'])&&!empty($_POST['author']))
{
    //Для редактирования существующей записи
    if(!empty($_POST['id']))
    {
        $query = "update `articles` set title='".$title."', content='".$content."', date_created='".$time."', author='".$author."' where id=".$_POST['id'];
        $res = mysql_query($query);

        // Ищем по article_id индексную запись
        $term = new Zend_Search_Lucene_Index_Term($_POST['id'], 'article_id');
        $query = new Zend_Search_Lucene_Search_Query_Term($term);
        $e_results = $index->find($query); // Тут результат поиска по article_id
        //Важный момент! Индекс нельзя отредактировать. Его можно удалить и снова записать.
        //Ниже мы все это и делаем
        if(count($e_results) > 0) {
            foreach($e_results as $result)
            {
                $index->delete($result->id);
                $index->commit();
            }
        }
        //Добавляем в индекс
        addtoIndex($index, $_POST['id'], $title, $content, $author, $time);
    }
    //Для создания новой записи
    else
    {
        $query = "INSERT INTO `articles`(title,content,date_created,author) VALUES('".$title."','".$content."','".$time."','".$author."')";
        $res = mysql_query($query);
        $last_id = mysql_insert_id();
        //Добавляем в индекс
        addtoIndex($index, $last_id, $title, $content, $author, $time);
    }
    if(!$res)
    {
        echo "INSERT HAS BEEN FAILED";
    }
}
?>
<!--
Теперь делаем форму поиска. Тут тоже все просто.
//-->
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div style="margin:40px; padding: 0px; background-color: green; width:900px;">
        <input type="text" size="132" name="search" onblur="if(this.value=='') this.value='Поиск по сайту';" onfocus="if(this.value=='Поиск по сайту') this.value='';"
               value="<?php if(!empty($_GET['search'])) { echo $_GET['search']; } else { echo 'Поиск по сайту'; } ;?>">
        <input type="submit" value="Поиск">
    </div>
</form>

<?php
//тут формируем вывод результатов поиска
if(strlen($_GET['search'])>2)
{
    if(count($results)>0)
    {
        echo "<div style='margin:30px; padding:10px; font-weight:bold;'>Всего найдено:".count($results)."</div>";
        echo "<ul style='list-style:none; max-width:900px; margin:30px; padding:10px;'>";
        foreach($results as $article)
        {
            echo "<li style='margin-bottom:10px;'>";
            echo "<div style='background-color:#bfd2db; padding:10px;'><strong>".$article->title."</strong> [автор:<i>".$article->author."</i>] опубликовано ".date("d/m/y",$article->date_created)." в ".date("G:i:s",$article->date_created)."<span style='float:right; font-size:24px; color:white;'>#".$article->article_id."</span></div>";
            echo "<div style='background-color:#ffffff; padding:10px;'>".nl2br($article->content)."</div>";
            echo "<div style='background-color:#ffffff; padding:2px;'><a href='".$PHP_SELF."?action=edit&id=".$article->id."#form'>редактировать</a> | <a href='".$PHP_SELF."?action=delete&id=".$article->id."'>удалить</a></div>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "<div style='margin:30px; padding:10px; font-weight:bold;'>Ничего не найдено</div>";
    }
}
// А тут результат выборки из БД
else
{
    $query = "select * from articles";
    $res = mysql_query($query);
    if(mysql_num_rows($res)>0)
    {
        echo "<ul style='list-style:none; max-width:900px; margin:30px; padding:10px;'>";
        while($article = mysql_fetch_array($res))
        {
            echo "<li style='margin-bottom:10px;'>";
            echo "<div style='background-color:#bfd2db; padding:10px;'><strong>".$article['title']."</strong> [автор:<i>".$article['author']."</i>] опубликовано ".date("d/m/y",$article['date_created'])." в ".date("G:i:s",$article['date_created'])."<span style='float:right; font-size:24px; color:white;'>#".$article['id']."</span></div>";
            echo "<div style='background-color:#ffffff; padding:10px;'>".nl2br($article['content'])."</div>";
            echo "<div style='background-color:#ffffff; padding:2px;'><a href='".$PHP_SELF."?action=edit&id=".$article['id']."#form'>редактировать</a> | <a href='".$PHP_SELF."?action=delete&id=".$article['id']."'>удалить</a></div>";
            echo "</li>";
        }
        echo "</ul>";
    }
}
?>
<!--
Ну а тут форма для создания новой записи
//-->
<div style="margin: 30px;">
    <a name="form"></a>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <ul style="list-style: none; padding: 5px; margin: 5px;">
            <li>Заголовок
                <input type="text" name="title" value="<?php echo empty($article_edit['title'])?'':$article_edit['title']; ?>"></li>
            <li>Содержание
                <textarea cols="60" rows="10" name="content"><?php echo empty($article_edit['content'])?'':$article_edit['content']; ?></textarea></li>
            <li>Автор
                <input type="text" name="author" value="<?php echo empty($article_edit['author'])?'':$article_edit['author']; ?>"></li>
            <li><input type="hidden" name="id" value="<?php echo empty($article_edit['id'])?'':$article_edit['id']; ?>"></li>
        </ul>
        <input style="margin: 10px; padding: 5px;" type="submit" value="<?php echo ($_GET['action']=='edit')?'Сохранить':'Создать'; ?>">
    </form>
</div>
