<? include_once("../libs/setting.php"); if(!isset($_SESSION)) include_once("../libs/start.php"); ?>

<h2><? echo $stringHeader; ?><h2>
<div class="infostrin">
  <p style="float:left; padding-left: 10px;">Вітаємо ви авторизовані як: <? echo (isset($_SESSION["nu"]))?$_SESSION["nu"]:"Гість"; ?></p>
  <p id="digital_watch" style="float:right; padding-right: 15px;  font-size:13px; font-weight: bold;"></p>
</div>


<ul id="menu">
  <li><a href="#">Головна</a></li>

  <li>
    <a href="#">Категории</a>
    <ul>
      <li>
        <a href="#">CSS</a>
        <ul>
          <li><a href="#">Пункт 11</a></li>
          <li><a href="#">Пункт 12</a></li>
          <li><a href="#">Пункт 13</a></li>
          <li><a href="#">Пункт 14</a></li>

        </ul>
      </li>
      <li>
        <a href="#">Дизайн</a>
        <ul>
          <li><a href="#">Пункт 21</a></li>
          <li><a href="#">Пункт 22</a></li>
          <li><a href="#">Пункт 23</a></li>
          <li><a href="#">Пункт 24</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Инструменты</a>
        <ul>
          <li><a href="#">Пункт 31</a></li>
          <li><a href="#">Пункт 32</a></li>
          <li><a href="#">Пункт 33</a></li>
          <li><a href="#">Пункт 34</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Веб дизайн</a>
        <ul>
          <li><a href="#">Пункт 41</a></li>
          <li><a href="#">Пункт 42</a></li>
          <li><a href="#">Пункт 43</a></li>
          <li><a href="#">Пункт 44</a></li>
        </ul>
      </li>
    </ul>
      </li>

  <li>
    <a href="#">Работы</a>
    <ul>
      <li>
        <a href="#">Работа 1</a>
        <ul>
          <li>
            <a href="#">Работа 11</a>
            <ul>

              <li>
                <a href="#">Работа 111</a>
              </li>
              <li>
                <a href="#">Работа 112</a>
              </li>
              <li>
                <a href="#">Работа 113</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Работа 12</a>
            <ul>
              <li>
                <a href="#">Работа 121</a>
              </li>
              <li>
                <a href="#">Работа 122</a>
              </li>
              <li>
                <a href="#">Работа 123</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#">Работа 13</a>
            <ul>
              <li>
                <a href="#">Работа 131</a>
              </li>
              <li>
                <a href="#">Работа 132</a>
              </li>
              <li>
                <a href="#">Работа 133</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>

        <a href="#">Работа 2</a>
        <ul>
          <li>
            <a href="#">Работа 21</a>
            <ul>
              <li>
                <a href="#">Работа 211</a>
              </li>
              <li>
                <a href="#">Работа 212</a>
              </li>
              <li>
                <a href="#">Работа 213</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#">Работа 22</a>
            <ul>
              <li>
                <a href="#">Работа 221</a>
              </li>
              <li>
                <a href="#">Работа 222</a>
              </li>
              <li>
                <a href="#">Работа 223</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Работа 23</a>
            <ul>
              <li>
                <a href="#">Работа 231</a>
              </li>
              <li>
                <a href="#">Работа 232</a>
              </li>
              <li>
                <a href="#">Работа 233</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="#">Работы 3</a>
        <ul>

          <li>
            <a href="#">Работа 31</a>
            <ul>
              <li>
                <a href="#">Работа 311</a>
              </li>
              <li>
                <a href="#">Работа 312</a>
              </li>
              <li>
                <a href="#">Работа 313</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Работа 32</a>
            <ul>
              <li>
                <a href="#">Работа 321</a>
              </li>
              <li>
                <a href="#">Работа 322</a>
              </li>
              <li>
                <a href="#">Работа 323</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Работы 33</a>
            <ul>
              <li>
                <a href="#">Работа 331</a>
              </li>
              <li>
                <a href="#">Работа 332</a>
              </li>
              <li>
                <a href="#">Работы 333</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <a href="#">О нас</a>
  </li>


  <li style="float:right;"  >
    <? if(isset($_SESSION["name"])){
        echo  "<a onClick=\"exitButon();\">Вихід</a>";
      }else{
        echo  "<a onClick=\"openAutorizathionForm();\">Увійти</a>";
      }
    ?>
  </li>

</ul>
