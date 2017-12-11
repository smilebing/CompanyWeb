<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 19:42
 */?>

<input id="searchTitle"><button onclick="search()">search</button>

<script>
    function search()
    {
        var title=$('searchTitle').val();
        console.log(title);
    }
</script>