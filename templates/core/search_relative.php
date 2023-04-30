<?php
//the collection part haven't finished (need right sql database structure)

//this is the page for the function about search
//types: SEARCH, LIKE, TIME, TAG, COLLECTION
function search_list($sql_link, $type = NULL, &$length = 0, $target = null, $limit = null, $offset = null, $cur_user = null, $object_user = null)
{
    $output = array();
    $sql = null;
    if (isset($target)) { //get data from novel table
        if ($type == "SEARCH") {
            $sql = "SELECT * FROM novel NATURAL JOIN tag WHERE tag LIKE '%$target%' OR nName LIKE '%$target%' ";
        } else if ($type == "TAG") {
            $sql = "SELECT * FROM novel n NATURAL JOIN tag t WHERE tag LIKE '%$target%'";
        } else if ($type == "COLLECTION" && isset($object_user)) {
            $sql = "SELECT * FROM novel n WHERE nId IN (
                SELECT nId FROM bookrecord b, keep k WHERE 'b.bId' = 'k.bId' AND collectId IN (
                    SELECT collectId FROM user u, collection c WHERE 'u.uId' = 'c.uId' AND 'u.uId' = '$object_user' AND 'c.collectName' = '$target')
            )";
            $order = "bLike";
        }
    }

    if ($type == "LIKE") {
        $sql = "SELECT * FROM novel WHERE nId";
        $order = "nLike";
    } else if ($type == "TIME") {
        $sql = "SELECT * FROM novel WHERE nId";
    }

    if (isset($sql)) {
        if (isset($cur_user)) {
            $avoid = " SELECT nId FROM bookrecord WHERE uId = '$cur_user' AND preference = 'HATE'";
            $sql .= " AND nId NOt IN ($avoid)";
        }
        if (isset($order)) {
            $sql .= " ORDER BY $order DESC";

        } else {
            $sql .= " ORDER BY nTime DESC";
        }
        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        //print($sql);
        $output = get_row($sql, $length, $sql_link);
        return $output;
    }

}
//you may need to know: 1.user name shold be unique
//don't set $cur_user if you want them to see things they hate
//the database may have change in some days, make sure the sql statement is right (ex.COLLECTION & AVOID)
?>