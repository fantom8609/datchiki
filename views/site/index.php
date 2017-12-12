<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
    <div class="container">
        <div class="row">

            <div style="float:right;">
                <?php foreach ($ustroistva as $ustroistvo): if($ustroistvo['trig']==1) {$trig="Вкл";} else {$trig="Выкл";}?>
                    <ul>
                        <li><?php echo $ustroistvo['name']."(".$trig.")"."<br>"."ID: ".$ustroistvo['id'] ?></li>
                        <a href="/delete_ustr/<?php echo $ustroistvo['id'];?>" class="btn ustr-delete">удалить</a>

                    </ul>
                <?php endforeach; ?>


                <div class="event_cont"> 
                    <div class="event_visible">                
                        <div class="visible_cont">
                            <a  title="" href="javascript:;" onmousedown="slidedown('ustroistvo_creating');
                            slideup('ustroistvo_creating');">Добавить исполнительное устройство</a>
                        </div>
                    </div>

                    <div id="ustroistvo_creating" class="about" style="display:none; overflow:hidden; height:265px;">  
                        <form method="POST">
                            <span>Название</span> <br>
                            <input type="text" name="name_ustr"> <br>
                            <span>Состояние (1/0 - вкл/выкл)</span><br>
                            <input type="text" name="value_ustr"> <br>
                            <input type="submit" name="submit_ustr" value="Добавить"> 
                        </form>
                    </div>
                </div>

            </div>


            



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
                            <input type="text" name="ustroistvo_id"> <br><br>
                            <input type="submit" name="submit" value="Добавить"> 
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>