<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 21:25
 */ ?>

<div class="center-block">
<!--    left div-->
    <div style="width:70%;float: left">
        <div>
            <?php
            require 'dbConfig.php';
            //查找数据库 FAQ数据
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                echo mysqli_connect_error();
                exit;
            }

            $sql = "select * from article where articleType='faq' limit 1";

            $result= $mysqli->query($sql);

            $content='';
            if ($result->num_rows > 0) {
                //获取数据
                while ($row = $result->fetch_assoc()) {
                    $content= $row['content'];
                }
            }
            $mysqli->close();
            echo $content;
            ?>
        </div>

        <div><strong>Q: What type of products do you offer?</strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A: </strong>APP Global is a supplier of raw nutritional materials for the manufacturing
            and further processing of beverage, cosmetic, food, nutritional, and other products. We
            specialize in the bulk categories of vitamins, amino acids, herbal extracts, and other special
            chemicals and mineral products.<br/>
            <br/>
            <br/>
            <strong>Q: How do I place an order with APP Global?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A:</strong> An order can be made by simply faxing a purchase order to our fax at
            909-598-8294, or by contacting our office at 909-598-1767. Purchase orders are also acceptable
            through emails.<br/>
            <br/>
            <br/>
            <strong>Q: What forms of payment do you accept?</strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A:</strong> We only accept checks and wire transfer.<br/>
            <br/>
            <br/>
            <strong>Q: What kind of services do you offer?</strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A: </strong>We offer product sourcing, raw materials, repacking, samples, delivery, and
            general customer service.&nbsp;<br/>
            <br/>
            <br/>
            <strong>Q: What is your return policy? </strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A:</strong> As for our return policy please contact us at 909-598-1767 or email to <a
                    href="mailto:info@appglobalinc.com">info@appglobalinc.com</a>.<br/>
            <br/>
            <br/>
            <strong>Q: What are your hours of operation?</strong><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
            <strong>A:</strong> We are open between 8:30am-5pm [PST] from Monday-Friday.<br/>
            <br/>
            <br/>
            <strong>Q: Is APP Global Inc. GMP and/or ISO certified?</strong><br/>
            <br/>
            <strong>A:</strong> No, we are a supplier of raw nutritional materials, but we do have an
            established Standard Operating Procedure (SOP), which all of our employees strictly follow, and
            operates within the Good Distribution Products (GDP) guidelines.<br/>
            <br/>
            <br/>
            <strong>Q: How do you ensure your products are safe and that they meet regulation
                requirements?</strong><br/>
            <br/>
            <strong>A: </strong>To ensure that our products are safe and meet regulation requirements we
            only purchase products manufactured by GMP and/or ISO certified facilities. Our established SOP&#39;s
            guidlines are to ensure product quality assurance and our product is frequently subjected to
            thrid party testing.<br/>
            <br/>
            <br/>
            <strong>Q: Do you offer repackaging services?</strong><br/>
            <br/>
            <strong>A:</strong> Yes, we offer repacking for any products of no less than 1 KG. Products in
            tin&#39;s and certified organics are excluded for repacking.<br/>
            <br/>
            <br/>
            <strong>Q: Is APP Global Inc affiliated with any organization?</strong><br/>
            <br/>
            <strong>A:</strong> Yes, we are member of the Natural Products Association (NPA) and we also
            commit ourselves to giving back to the community by contributing donation to organizations such
            as iFeeder.<br/>
            <br/>
            <br/>
            <strong>Q: What kind of packaging do your materials come in?</strong><br/>
            <br/>
            <strong>A:</strong> Our materials are packaged in a 25kg, 20kg, 1kg and/or 1g carton, drum, tin
            depending on the material.<br/>
            <br/>
            <br/>
            <strong>Q: How often do you test your materials? &nbsp;And what do you test for?</strong><br/>
            <br/>
            <strong>A:</strong> Every imported raw materials we do assay, heavy metals, and microbiology
            testing.<br/>
            <br/>
            <br/>
            <strong>Q: For testing materials, do you use an in-house laboratory or a 3<sup>rd</sup> party
                laboratory? </strong><br/>
            <br/>
            <strong>A:</strong> <a href="http://www.covance.com/">Convance</a> and <a
                    href="http://www.eurofins.com/en.aspx">Eurofins</a> is our primary 3<sup>rd</sup> party
            laboratories we use to test our materials.
        </div>
    </div>
<!--left div end-->

<?php require 'rightBar.php'?>
</div>

