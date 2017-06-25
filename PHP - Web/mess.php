<?php

class Message{
    var $time;
    var $name;
    var $content;
    var $flat;
    var $pic;

    function __construct($n,$t,$c,$f,$p){
        $this->name = $n;
        $this->time = $t;
        $this->content = $c;
        $this->flat = $f;
        $this->pic = $p;
    }
    function show(){
        echo "<div class = row 50%>";  
        if($this->flat==2){
            echo "<div class = 4u>";
            ?>
            <a href="#" class="image fit"><img src="<?php echo $this->pic ?>"width="200" height="200"  style="border-radius:50%; alt="" /></a>
            <?php
            echo "<h4>拜訪者:".$this->name."</h4>";
            echo "</div>";
        }
        echo "<div class=8u>";
        echo "<p>訊息時間：$this->time</p>";
        echo "<p>$this->content</p>"; 
        echo "</div>";
        if($this->flat==1){
            echo "<div class = 4u>";
            ?>
            <a href="#" class="image fit"><img src="<?php echo $this->pic ?>"width="200" height="200"  style="border-radius:50%; alt="" /></a>
            <?php
            echo "<h4>案件人:".$this->name."</h4>";
            echo "</div>";
        }
        echo "</div>";
        echo "<hr style='high:1px color:#00ff00'>";
        
    }
}

class db{
    function __construct(){
       $this->conn = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
       mysqli_set_charset($this->conn,"utf8");

    }
    function __destruct(){
        mysqli_close($this->conn);
    }
}
?>
