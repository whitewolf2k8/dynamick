<? include_once("../libs/setting.php"); if(!isset($_SESSION)) include_once("../libs/start.php"); ?>

<h2><? echo $stringHeader; ?><h2>
<div class="infostrin">
  <p style="float:left; padding-left: 10px;">³���� �� ����������� ��: <? echo (isset($_SESSION["nu"]))?$_SESSION["nu"]:"ó���"; ?></p>
  <p id="digital_watch" style="float:right; padding-right: 15px;  font-size:13px; font-weight: bold;"></p>
</div>


<ul id="menu">
  <li><a href="#">�������</a></li>

  <li>
    <a href="#">���������</a>
    <ul>
      <li>
        <a href="#">CSS</a>
        <ul>
          <li><a href="#">����� 11</a></li>
          <li><a href="#">����� 12</a></li>
          <li><a href="#">����� 13</a></li>
          <li><a href="#">����� 14</a></li>

        </ul>
      </li>
      <li>
        <a href="#">������</a>
        <ul>
          <li><a href="#">����� 21</a></li>
          <li><a href="#">����� 22</a></li>
          <li><a href="#">����� 23</a></li>
          <li><a href="#">����� 24</a></li>
        </ul>
      </li>
      <li>
        <a href="#">�����������</a>
        <ul>
          <li><a href="#">����� 31</a></li>
          <li><a href="#">����� 32</a></li>
          <li><a href="#">����� 33</a></li>
          <li><a href="#">����� 34</a></li>
        </ul>
      </li>
      <li>
        <a href="#">��� ������</a>
        <ul>
          <li><a href="#">����� 41</a></li>
          <li><a href="#">����� 42</a></li>
          <li><a href="#">����� 43</a></li>
          <li><a href="#">����� 44</a></li>
        </ul>
      </li>
    </ul>
      </li>

  <li>
    <a href="#">������</a>
    <ul>
      <li>
        <a href="#">������ 1</a>
        <ul>
          <li>
            <a href="#">������ 11</a>
            <ul>

              <li>
                <a href="#">������ 111</a>
              </li>
              <li>
                <a href="#">������ 112</a>
              </li>
              <li>
                <a href="#">������ 113</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">������ 12</a>
            <ul>
              <li>
                <a href="#">������ 121</a>
              </li>
              <li>
                <a href="#">������ 122</a>
              </li>
              <li>
                <a href="#">������ 123</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#">������ 13</a>
            <ul>
              <li>
                <a href="#">������ 131</a>
              </li>
              <li>
                <a href="#">������ 132</a>
              </li>
              <li>
                <a href="#">������ 133</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>

        <a href="#">������ 2</a>
        <ul>
          <li>
            <a href="#">������ 21</a>
            <ul>
              <li>
                <a href="#">������ 211</a>
              </li>
              <li>
                <a href="#">������ 212</a>
              </li>
              <li>
                <a href="#">������ 213</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#">������ 22</a>
            <ul>
              <li>
                <a href="#">������ 221</a>
              </li>
              <li>
                <a href="#">������ 222</a>
              </li>
              <li>
                <a href="#">������ 223</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">������ 23</a>
            <ul>
              <li>
                <a href="#">������ 231</a>
              </li>
              <li>
                <a href="#">������ 232</a>
              </li>
              <li>
                <a href="#">������ 233</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="#">������ 3</a>
        <ul>

          <li>
            <a href="#">������ 31</a>
            <ul>
              <li>
                <a href="#">������ 311</a>
              </li>
              <li>
                <a href="#">������ 312</a>
              </li>
              <li>
                <a href="#">������ 313</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">������ 32</a>
            <ul>
              <li>
                <a href="#">������ 321</a>
              </li>
              <li>
                <a href="#">������ 322</a>
              </li>
              <li>
                <a href="#">������ 323</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">������ 33</a>
            <ul>
              <li>
                <a href="#">������ 331</a>
              </li>
              <li>
                <a href="#">������ 332</a>
              </li>
              <li>
                <a href="#">������ 333</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <a href="#">� ���</a>
  </li>


  <li style="float:right;"  >
    <? if(isset($_SESSION["name"])){
        echo  "<a onClick=\"exitButon();\">�����</a>";
      }else{
        echo  "<a onClick=\"openAutorizathionForm();\">�����</a>";
      }
    ?>
  </li>

</ul>
