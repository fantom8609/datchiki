<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!--вывод всех датчиков-->
                <form method="post">
                    <?php foreach($datchiki as $datchik): ?>
                    <span><?php echo $datchik['name'];?></span><br>
                    <input type="text" name="<?php echo $datchik['name'];?>"> <span><?php echo $datchik['izm'];?></span><br>
                    <a href="/delete/<?php echo $datchik['id'];?>" class="btn datchik-delete">удалить</a> <br><br>
                    <?php endforeach; ?>
                    <input type="submit" name="set" value="Установить значения датчиков"> 
                </form>


                <?php foreach ($ustroistva as $ustroistvo): if($ustroistvo['trig']==1) {$trig="Вкл";} else {$trig="Выкл";}?>

                    <ul>
                        <li><?php echo $ustroistvo['name']."(".$trig.")"."<br>"."ID: ".$ustroistvo['id'] ?></li>
                    </ul>

                <?php endforeach; ?>



                <br>

                <div class="event_cont"> 
                    <div class="event_visible">                
                        <div class="visible_cont">
                            <a  title="" href="javascript:;" onmousedown="slidedown('mydiv');slideup('mydiv');">Добавить датчик</a>
                        </div>
                    </div>

                    <div id="mydiv" class="about" style="display:none; overflow:hidden; height:265px;">  
                        <form method="POST">
                            <span>Название</span> <br>
                            <input type="text" name="name"> <br>
                            <span>Значение</span><br>
                            <input type="text" name="value"> <br>
                            <span>Единица измерения</span><br>
                            <input type="text" name="izm"> <br><br>
                            <span>ID исполнительного устройства</span><br>
                            <input type="text" name="ustr_id"> <br><br>
                            <input type="submit" name="submit" value="Добавить"> 
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>